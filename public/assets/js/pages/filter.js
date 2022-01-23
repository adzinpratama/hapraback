/*=========================================================================================
    File Name: filter.js
    Description: filter
    ----------------------------------------------------------------------------------------
    Author: Hapra
==========================================================================================*/

'use strict';

$(function () {

    /*===================================================================================
        Global Variable Init
    =====================================================================================*/
    var newTaskModal = $('.sidebar-filter-modal'),
        favoriteStar = $('.filter-item-favorite'),
        modalTitle = $('.modal-title'),
        overlay = $('.body-content-overlay'),
        menuToggle = $('.menu-toggle'),
        sidebarToggle = $('.sidebar-toggle'),
        sidebarLeft = $('.sidebar-left'),
        sidebarMenuList = $('.sidebar-menu-list'),
        filterFilter = $('#filter-search'),
        sortAsc = $('.sort-asc'),
        sortDesc = $('.sort-desc'),
        filterTaskList = $('.filter-task-list'),
        filterTaskListWrapper = $('.filter-task-list-wrapper'),
        listItemFilter = $('.list-group-filters'),
        noResults = $('.no-results'),
        isRtl = $('html').attr('data-textdirection') === 'rtl';

    let listWraper = $('#filter-wrap'),
        searchBox = $('#filter-search'),
        filterList = $('#filter-list'),
        parentSelection = $('#parent'),
        language = parentSelection.data('locale'),
        formModal = $('#form-modal'),
        btnSave = $('#btn-save'),
        areaInput = $('.area-input'),
        btnUpdate = $('#btn-update');

    let modalForm = document.querySelector('#form-modal'),
        triggerBtn = document.getElementById('btn-trigger'),
        current = document.getElementById('current');
    /*===================================================================================
        FIlter Page Init and Load extension
    =====================================================================================*/
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
    });

    let choseActive = $('.list-group-filters').find('.active').data('toggle');
    current.dataset.type = choseActive;
    getList(route('filter.index'), {
        load: choseActive
    });

    $('[data-toggle="popover"]').popover();

    let confirm = $.confirm({
        lazyOpen: true,
        type: 'purple',
        theme: 'light',
    });


    if (parentSelection.length) {
        parentSelection.wrap('<div class="position-relative"></div>');
        let selecter = parentSelection.select2({
            language: language,
            allowClear: true,
            ajax: {
                url: route('category.select'),
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.title,
                                id: item.id
                            }
                        })
                    }
                }
            },
        });
    }

    const generateSlug = (value) => {
        return value.trim()
            .toLowerCase()
            .replace(/[^a-z\d-]/gi, '-')
            .replace(/-+/g, '-').replace(/^-|-$/g, "");
    }

    const ajaxSend = (route, option) => {
        let beforeSend = {
            beforeSend: () => {
                return loader()
            }
        };
        // let push = { ...option, ...beforeSend };
        let push = Object.assign(beforeSend, option);
        // $(document).ajaxStart(() => { return loader() });
        return $.ajax(route, push).then(res => {
            if (res.status) {
                notif(res.status, res.message);
                overlays();
                return getTag();
            }
        }).catch(({
            responseJSON: e
        }) => {
            if (typeof (e) == 'object') {
                $.each(e, (key, value) => {
                    $('#' + key).addClass('is-invalid');
                    $('#valid-' + key).text(value);
                })
            }
            if (e.message) notif('error', e.message);
        })
    }

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

    const reload = (type) => {
        document.querySelector('a[data-toggle="' + type + '"').click();
    }

    const normalize = () => {
        menuAdd.classList.remove('d-none');
        menuSelect.forEach(el => el.classList.add('d-none'));
    }

    const edit = (el) => {
        let data = el.data();
        for (let [key, value] of Object.entries(data)) {
            if (key == 'parent') {
                let newOption = new Option(data.parenttext, value, true, true);
                $('#parent').append(newOption).trigger('change');
            }
            $('#' + key).val(value);
        }
    }
    const notif = (type, message) => {
        return toastr[type](message, {
            closeButton: true,
            tapToDismiss: false,
            rtl: isRtl
        });
    }
    /*===================================================================================
        while title on keyup
    =====================================================================================*/
    let inputTitle = document.getElementById('title'),
        inputSlug = document.getElementById('slug');
    inputTitle.onkeyup = () => {
        inputSlug.value = generateSlug(inputTitle.value);
    }
    /*===================================================================================
        While Button Trigger onclick
    =====================================================================================*/
    triggerBtn.onclick = () => {
        let id = document.getElementById('key').value,
            data = triggerBtn.dataset,
            url = data.method == 'put' ? route(data.route, {
                id
            }) : route(data.route);
        return action(url, data.method);
    }
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

    /*===================================================================================
        Menu pop Action
    =====================================================================================*/
    let groupCategory = $('.group-category'),
        dataTitle = modalTitle.data();
    const addTag = () => {
        groupCategory.addClass('d-none');
        modalTitle.text(dataTitle.tag);
        triggerBtn.dataset.type = 'tags';
        newTaskModal.modal('show');
    }

    const addCategory = () => {
        groupCategory.removeClass('d-none');
        modalTitle.text(dataTitle.category);
        triggerBtn.dataset.type = 'category';
        newTaskModal.modal('show');
    }

    btnMenu.forEach(el => {
        let data = el.dataset
        el.onclick = () => {
            toggle.click();
            modalForm.reset();
            parentSelection.val(null).trigger('change');
            triggerBtn.innerText = triggerBtn.dataset.addname;
            triggerBtn.dataset.method = "post";
            if (data.action == 'add-tag') {
                triggerBtn.dataset.route = 'tags.store';
                return addTag();
            }
            if (data.action == 'add-category') {
                triggerBtn.dataset.route = 'category.store';
                return addCategory();
            }

        }
    });

    menuEdit.onclick = () => {
        triggerBtn.innerText = triggerBtn.dataset.updatename;
        triggerBtn.dataset.method = 'put';
        if (current.dataset.type == 'category') {
            triggerBtn.dataset.route = 'category.update';
            return addCategory();
        }
        triggerBtn.dataset.route = 'tags.update';
        return addTag();
    };

    menuDelete.onclick = () => {
        let allChecked = $(document).find('.select-single:checked'),
            countId = [];
        allChecked.each(function () {
            countId.push($(this).data('key'))
        });
        if (countId.length < 1) return notif('error', 'Tidak ada item terpilih');
        let url = current.dataset.type == 'tags' ? 'tags.destroy' : 'category.destroy';

        confirm.title = `Delete ${countId.length} Files`;
        confirm.icon = 'uil uil-trash';
        confirm.buttons.ok.text = 'Delete';
        confirm.buttons.ok.btnClass = 'btn-purple';
        confirm.buttons.ok.action = () => {
            return send(route(url, {
                id: countId
            }), {
                method: 'delete',
            }).then(res => {
                notif(res.status, res.message);
                reload(current.dataset.type);
                normalize();
            }).catch(err => errorHandling(err));
        }
        confirm.open();
    }

    /*===================================================================================
        Select All
    =====================================================================================*/
    $(document).on('click', '.filter-app-list .selectAll input', function () {
        if ($(this).is(':checked')) {
            $(document)
                .find('.custom-checkbox input')
                .prop('checked', this.checked)
                .closest('.filter-item')
                .addClass('completed');
            menuAdd.classList.add('d-none');
            menuDelete.classList.remove('d-none');
        } else {
            $(document).find('.custom-checkbox input')
                .prop('checked', '')
                .closest('.filter-item')
                .removeClass('completed');
            return normalize();
        }
    });

    /*===================================================================================
        checkbox item onchange
    =====================================================================================*/
    $(document).on('change', '.select-single', function () {
        let allChecked = $(document).find('.select-single:checked');
        if (allChecked.length > 1) {
            menuEdit.classList.add('d-none');
        } else if (allChecked.length > 0) {
            edit(allChecked);
            menuAdd.classList.add('d-none');
            menuSelect.forEach(el => el.classList.remove('d-none'));
        } else {
            return normalize();
        }
    })
    /*===================================================================================
        While Pagination onclick
    =====================================================================================*/
    $(document).on('click', '#link a', function (e) {
        e.preventDefault();
        let url = $(this).attr('href'),
            optionActive = $('.list-group-filters .active').data();
        return getList(url, {
            load: optionActive.toggle
        });
    })
    /*===================================================================================
        While Nodes Category onClick
    =====================================================================================*/
    $(document).on('click', '.nodes,.back', function (e) {
        e.preventDefault();
        let data = $(this).data();
        return getList(route('filter.index'), {
            load: data.type,
            key: data.key,
            parent: data.parent
        }).then(res => normalize());
    })

    /*===================================================================================
        Drag and Drop Category
    =====================================================================================*/
    var dndContainer = document.getElementById('filter-list');
    // if (typeof dndContainer !== undefined && dndContainer !== null) {
    dragula([dndContainer], {
        moves: function (el, container, handle) {
            return handle.classList.contains('drag-icon');
        }
    });
    // }
    /*===================================================================================
        while on click of item
    =====================================================================================*/
    $(document).on('click', '.filter-task-list-wrapper .filter-item', function (e) {
        let checkbox = $(this).find('input[type="checkbox"]');
        checkbox.prop('checked', !checkbox.prop('checked')).trigger('change');
    });



    // if it is not touch device
    if (!$.app.menu.is_touch_device()) {
        if (sidebarMenuList.length > 0) {
            var sidebarListScrollbar = new PerfectScrollbar(sidebarMenuList[0], {
                theme: 'dark'
            });
        }
        if (filterTaskListWrapper.length > 0) {
            var taskListScrollbar = new PerfectScrollbar(filterTaskListWrapper[0], {
                theme: 'dark'
            });
        }
    }
    // if it is a touch device
    else {
        sidebarMenuList.css('overflow', 'scroll');
        filterTaskListWrapper.css('overflow', 'scroll');

    }

    // Add class active on click of sidebar filters list
    if (listItemFilter.length) {
        listItemFilter.find('a').on('click', function () {
            if (listItemFilter.find('a').hasClass('active')) {
                listItemFilter.find('a').removeClass('active');
            }
            $(this).addClass('active');
            let option = $(this).data();
            current.dataset.type = option.toggle;
            overlay.click();
            return getList(route('filter.index'), {
                load: option.toggle
            }).then(res => normalize());
        });
    }

    // Main menu toggle should hide app menu
    if (menuToggle.length) {
        menuToggle.on('click', function (e) {
            sidebarLeft.removeClass('show');
            overlay.removeClass('show');
        });
    }

    // filter sidebar toggle
    if (sidebarToggle.length) {
        sidebarToggle.on('click', function (e) {
            e.stopPropagation();
            sidebarLeft.toggleClass('show');
            overlay.addClass('show');
        });
    }

    // On Overlay Click
    if (overlay.length) {
        overlay.on('click', function (e) {
            sidebarLeft.removeClass('show');
            overlay.removeClass('show');
            $(newTaskModal).modal('hide');
        });
    }

    // Sort Ascending
    if (sortAsc.length) {
        sortAsc.on('click', function () {
            filterTaskListWrapper
                .find('#filter-list > li')
                .sort(function (a, b) {
                    return $(b).find('.filter-title').text().toUpperCase() < $(a).find('.filter-title').text().toUpperCase() ? 1 : -1;
                })
                .appendTo(filterTaskList);
        });
    }
    // Sort Descending
    if (sortDesc.length) {
        sortDesc.on('click', function () {
            filterTaskListWrapper
                .find('#filter-list > li')
                .sort(function (a, b) {
                    return $(b).find('.filter-title').text().toUpperCase() > $(a).find('.filter-title').text().toUpperCase() ? 1 : -1;
                })
                .appendTo(filterTaskList);
        });
    }

    if (filterFilter.length) {
        filterFilter.on('keyup', delay(function () {
            return getList(route('filter.index'), {
                search: $(this).val().toLowerCase(),
                load: current.dataset.type
            });
        }, 500))
    }

    // For chat sidebar on small screen
    if ($(window).width() > 992) {
        if (overlay.hasClass('show')) {
            overlay.removeClass('show');
        }
    }

    function delay(fn, ms) {
        let timer = 0
        return function (...args) {
            clearTimeout(timer)
            timer = setTimeout(fn.bind(this, ...args), ms || 0)
        }
    }

    function loader(type = '') {
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

    function getList(url, option) {
        let push = Object.assign({
            beforeSend: () => {
                loader('list')
            }
        }, option);
        $(document).ajaxComplete(() => {
            return listWraper.unblock()
        })
        return $.get(url, push).then(res => {
            filterList.html(res);
        })
    }
});

$(window).on('resize', function () {
    // remove show classes from sidebar and overlay if size is > 992
    if ($(window).width() > 992) {
        if ($('.body-content-overlay').hasClass('show')) {
            $('.sidebar-left').removeClass('show');
            $('.body-content-overlay').removeClass('show');
            $('.sidebar-filter-modal').modal('hide');
        }
    }
});
