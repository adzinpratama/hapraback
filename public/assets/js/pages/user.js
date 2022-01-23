/*=========================================================================================
    File Name: user.js
    Description: users Page js
    ----------------------------------------------------------------------------------------
    Author: Hapra
==========================================================================================*/

'use strict';

$(function () {
    // Register Quill Fonts
    var Font = Quill.import('formats/font');
    Font.whitelist = ['sofia', 'slabo', 'roboto', 'inconsolata', 'ubuntu'];
    Quill.register(Font, true);

    var compose = $('.compose-users'),
        composeModal = $('#compose-detail'),
        menuToggle = $('.menu-toggle'),
        sidebarToggle = $('.sidebar-toggle'),
        sidebarLeft = $('.sidebar-left'),
        sidebarMenuList = $('.sidebar-menu-list'),
        usersAppList = $('.users-app-list'),
        usersUserList = $('.users-user-list'),
        usersUserListInput = $('.users-user-list .custom-checkbox'),
        usersScrollArea = $('.users-scroll-area'),
        usersTo = $('#users-to'),
        usersCC = $('#usersCC'),
        usersBCC = $('#usersBCC'),
        toggleCC = $('.toggle-cc'),
        toggleBCC = $('.toggle-bcc'),
        wrapperCC = $('.cc-wrapper'),
        wrapperBCC = $('.bcc-wrapper'),
        usersDetails = $('.users-app-details'),
        listGroupMsg = $('.list-group-messages'),
        goBack = $('.go-back'),
        favoriteStar = $('.users-application .users-favorite'),
        userActions = $('.user-action'),
        detailDelete = $('.detail-delete'),
        detailUnread = $('.detail-unread'),
        usersSearch = $('#users-search'),
        editorEl = $('#message-editor .editor'),
        overlay = $('.body-content-overlay'),
        isRtl = $('html').attr('data-textdirection') === 'rtl';

    let listWraper = $('#list-wraper');

    /*=========================================================================================
        User Page init and ekstension install
    ==========================================================================================*/

    const send = (route, option) => {
        loader();
        let token = document.querySelector('input[name="_token"]'),
            setup = {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": token.getAttribute('value')
                },
                credentials: "same-origin"
            },
            push = Object.assign(setup, option);
        return fetch(route, push).then(res => {
            $.unblockUI();
            if (!res.ok) throw res.json();
            else return res.json();
        });
    }

    const errorHandling = (er) => {
        er.then(res => {
            if (typeof (er) == 'object') {
                for (const [key, value] of Object.entries(res)) {
                    document.getElementById(key).classList.add('is-invalid');
                    document.getElementById('valid-' + key).textContent = value;
                }
            }
            if (res.message) notif('error', res.message);
        })
    }

    const action = (route, method) => {
        areaInput.removeClass('is-invalid');
        let form = new FormData(modalForm),
            data = {};
        for (let [key, value] of form) {
            data[key] = value;
        }
        return send(route, {
            method,
            body: JSON.stringify(data)
        }).then(res => {
            notif(res.status, res.message);
            normalize();
            reload(triggerBtn.dataset.type);
        }).catch(er => errorHandling(er));
    }

    const notif = (type, message) => {
        return toastr[type](message, {
            closeButton: true,
            tapToDismiss: false,
            rtl: isRtl
        });
    }

    const loader = (type) => {
        let option = {
            message: '<div class="spinner-border text-primary" role="status"></div>',
            css: {
                backgroundColor: 'transparent',
                color: '#fff',
                border: '0'
            },
            overlayCSS: {
                opacity: 0.5
            }
        };
        if (type == 'list') {
            return listWraper.block(option);
        } else {
            return $.blockUI(option);
        }
    }

    const getList = (url, option = {}) => {
        let push = Object.assign({
            beforeSend: () => {
                loader('list')
            }
        }, option);
        $(document).ajaxComplete(() => {
            return listWraper.unblock()
        })
        return $.get(url, push).then(res => {
            console.log(res);
            listWraper.html(res);
        })
    }

    getList(route('users.index'));

    /*===================================================================================
        Pop Menu
    =====================================================================================*/
    let toggle = document.getElementById('add'),
        menuAdd = document.getElementById('menu-add'),
        menuEdit = document.getElementById('menu-edit'),
        menuDelete = document.getElementById('menu-delete'),
        menuSelect = document.querySelectorAll('.menu-select'),
        btnMenu = document.querySelectorAll('.btn-menu'),
        menuOverlay = document.querySelector('.menu-overlay');

    toggle.onclick = () => {
        menuAdd.classList.toggle('active')
        if (menuAdd.classList.contains('active')) menuOverlay.classList.add('show');
        else menuOverlay.classList.remove('show');
    }

    menuOverlay.onclick = () => {
        toggle.click()
    }


    /*=========================================================================================
        User List On click, show detail
    ==========================================================================================*/
    $(document).on('click', '.users-media-list li .media-body', function (e) {
        usersDetails.toggleClass('show');
    })

    var assetPath = '../../../app-assets/';

    if ($('body').attr('data-framework') === 'laravel') {
        assetPath = $('body').attr('data-asset-path');
    }

    // Toggle BCC on mount
    if (wrapperBCC.length) {
        wrapperBCC.toggle();
    }

    // Toggle CC on mount
    if (wrapperCC) {
        wrapperCC.toggle();
    }

    // Toggle BCC input
    if (toggleBCC.length) {
        toggleBCC.on('click', function () {
            wrapperBCC.toggle();
        });
    }

    // Toggle CC input
    if (toggleCC.length) {
        toggleCC.on('click', function () {
            wrapperCC.toggle();
        });
    }

    // if it is not touch device
    if (!$.app.menu.is_touch_device()) {
        // users left Sidebar
        if ($(sidebarMenuList).length > 0) {
            var sidebar_menu_list = new PerfectScrollbar(sidebarMenuList[0]);
        }

        // User list scroll
        if ($(usersUserList).length > 0) {
            var users_list = new PerfectScrollbar(usersUserList[0]);
        }

        // users detail section
        if ($(usersScrollArea).length > 0) {
            var users_list = new PerfectScrollbar(usersScrollArea[0]);
        }
    }
    // if it is a touch device
    else {
        $(sidebarMenuList).css('overflow', 'scroll');
        $(usersUserList).css('overflow', 'scroll');
        $(usersScrollArea).css('overflow', 'scroll');
    }

    // users to user select
    function renderGuestAvatar(option) {
        if (!option.id) {
            return option.text;
        }
        var avatarImg = feather.icons['user'].toSvg({
            class: 'mr-0'
        });
        if ($(option.element).data('avatar')) {
            avatarImg = "<img src='" + assetPath + 'images/avatars/' + $(option.element).data('avatar') + "' alt='avatar' />";
        }

        var $avatar =
            "<div class='d-flex flex-wrap align-items-center'>" +
            "<div class='avatar avatar-sm my-0 mr-50'>" +
            "<span class='avatar-content'>" +
            avatarImg +
            '</span>' +
            '</div>' +
            option.text +
            '</div>';

        return $avatar;
    }
    if (usersTo.length) {
        usersTo.wrap('<div class="position-relative"></div>').select2({
            placeholder: 'Select value',
            dropdownParent: usersTo.parent(),
            closeOnSelect: false,
            templateResult: renderGuestAvatar,
            templateSelection: renderGuestAvatar,
            tags: true,
            tokenSeparators: [',', ' '],
            escapeMarkup: function (es) {
                return es;
            }
        });
    }

    if (usersCC.length) {
        usersCC.wrap('<div class="position-relative"></div>').select2({
            placeholder: 'Select value',
            dropdownParent: usersCC.parent(),
            closeOnSelect: false,
            templateResult: renderGuestAvatar,
            templateSelection: renderGuestAvatar,
            tags: true,
            tokenSeparators: [',', ' '],
            escapeMarkup: function (es) {
                return es;
            }
        });
    }

    if (usersBCC.length) {
        usersBCC.wrap('<div class="position-relative"></div>').select2({
            placeholder: 'Select value',
            dropdownParent: usersBCC.parent(),
            closeOnSelect: false,
            templateResult: renderGuestAvatar,
            templateSelection: renderGuestAvatar,
            tags: true,
            tokenSeparators: [',', ' '],
            escapeMarkup: function (es) {
                return es;
            }
        });
    }

    // compose users
    if (compose.length) {
        compose.on('click', function () {
            // showing rightSideBar
            overlay.removeClass('show');
            // hiding left sidebar
            sidebarLeft.removeClass('show');
            // all input forms
            $('.compose-form input').val('');
            usersTo.val([]).trigger('change');
            usersCC.val([]).trigger('change');
            usersBCC.val([]).trigger('change');
            wrapperCC.hide();
            wrapperBCC.hide();

            // quill editor content
            var quill_editor = $('.compose-form .ql-editor');
            quill_editor[0].innerHTML = '';
        });
    }

    // Main menu toggle should hide app menu
    if (menuToggle.length) {
        menuToggle.on('click', function (e) {
            sidebarLeft.removeClass('show');
            overlay.removeClass('show');
        });
    }

    // users sidebar toggle
    if (sidebarToggle.length) {
        sidebarToggle.on('click', function (e) {
            e.stopPropagation();
            sidebarLeft.toggleClass('show');
            overlay.addClass('show');
        });
    }

    // Overlay Click
    if (overlay.length) {
        overlay.on('click', function (e) {
            sidebarLeft.removeClass('show');
            overlay.removeClass('show');
        });
    }

    // users Right sidebar toggle
    if (usersUserList.find('li').length) {
        usersUserList.find('li').on('click', function (e) {
            usersDetails.toggleClass('show');
        });
    }

    // Add class active on click of sidebar list
    if (listGroupMsg.find('a').length) {
        listGroupMsg.find('a').on('click', function () {
            if (listGroupMsg.find('a').hasClass('active')) {
                listGroupMsg.find('a').removeClass('active');
            }
            $(this).addClass('active');
        });
    }

    // users detail view back button click
    if (goBack.length) {
        goBack.on('click', function (e) {
            e.stopPropagation();
            usersDetails.removeClass('show');
        });
    }

    // Favorite star click
    if (favoriteStar.length) {
        favoriteStar.on('click', function (e) {
            $(this).find('svg').toggleClass('favorite');
            e.stopPropagation();
            // show toast only have favorite class
            if ($(this).find('svg').hasClass('favorite')) {
                toastr['success']('Updated detail to favorite', 'Favorite detail ⭐️', {
                    closeButton: true,
                    tapToDismiss: false,
                    rtl: isRtl
                });
            }
        });
    }

    // For app sidebar on small screen
    if ($(window).width() > 768) {
        if (overlay.hasClass('show')) {
            overlay.removeClass('show');
        }
    }

    // single checkbox select
    if (usersUserListInput.length) {
        usersUserListInput.on('click', function (e) {
            e.stopPropagation();
        });
        usersUserListInput.find('input').on('change', function (e) {
            e.stopPropagation();
            var $this = $(this);
            if ($this.is(':checked')) {
                $this.closest('.media').addClass('selected-row-bg');
            } else {
                $this.closest('.media').removeClass('selected-row-bg');
            }
        });
    }

    // select all
    $(document).on('click', '.users-app-list .selectAll input', function () {
        if ($(this).is(':checked')) {
            userActions
                .find('.custom-checkbox input')
                .prop('checked', this.checked)
                .closest('.media')
                .addClass('selected-row-bg');
        } else {
            userActions.find('.custom-checkbox input').prop('checked', '').closest('.media').removeClass('selected-row-bg');
        }
    });

    // Delete selected detail from list
    if (detailDelete.length) {
        detailDelete.on('click', function () {
            if (userActions.find('.custom-checkbox input:checked').length) {
                userActions.find('.custom-checkbox input:checked').closest('.media').remove();
                usersAppList.find('.selectAll input').prop('checked', false);
                toastr['error']('You have removed users.', 'detail Deleted!', {
                    closeButton: true,
                    tapToDismiss: false,
                    rtl: isRtl
                });
                userActions.find('.custom-checkbox input').prop('checked', '');
            }
        });
    }

    // Mark detail unread
    if (detailUnread.length) {
        detailUnread.on('click', function () {
            userActions.find('.custom-checkbox input:checked').closest('.media').removeClass('detail-read');
        });
    }

    // Filter
    if (usersSearch.length) {
        usersSearch.on('keyup', function () {
            var value = $(this).val().toLowerCase();
            if (value !== '') {
                usersUserList.find('.users-media-list li').filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
                var tbl_row = usersUserList.find('.users-media-list li:visible').length;

                //Check if table has row or not
                if (tbl_row == 0) {
                    usersUserList.find('.no-results').addClass('show');
                    usersUserList.animate({
                        scrollTop: '0'
                    }, 500);
                } else {
                    if (usersUserList.find('.no-results').hasClass('show')) {
                        usersUserList.find('.no-results').removeClass('show');
                    }
                }
            } else {
                // If filter box is empty
                usersUserList.find('.users-media-list li').show();
                if (usersUserList.find('.no-results').hasClass('show')) {
                    usersUserList.find('.no-results').removeClass('show');
                }
            }
        });
    }

    // users compose Editor
    if (editorEl.length) {
        var usersEditor = new Quill(editorEl[0], {
            bounds: '#message-editor .editor',
            modules: {
                formula: true,
                syntax: true,
                toolbar: '.compose-editor-toolbar'
            },
            placeholder: 'Message',
            theme: 'snow'
        });
    }

    // On navbar search and bookmark Icon click, hide compose detail
    $('.nav-link-search, .bookmark-star').on('click', function () {
        composeModal.modal('hide');
    });
});

$(window).on('resize', function () {
    var sidebarLeft = $('.sidebar-left');
    // remove show classes from sidebar and overlay if size is > 992
    if ($(window).width() > 768) {
        if ($('.app-content .body-content-overlay').hasClass('show')) {
            sidebarLeft.removeClass('show');
            $('.app-content .body-content-overlay').removeClass('show');
        }
    }
});
