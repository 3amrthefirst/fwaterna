// Upgrade button class name
$.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-sm';

$(document).ready(function () {
    $('.dataTables-example').DataTable({
        // pageLength: 25,
        bFilter: false,
        bPaginate: false,
        bInfo: false,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            // {extend: 'copy'},
            // {extend: 'csv'},
            // {extend: 'excel', title: 'ExampleFile'},
            // {extend: 'pdf', title: 'ExampleFile'},

            {
                // extend: 'print',
                customize: function (win) {
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');

                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                }
            }
        ],
        language: {
            "emptyTable": "ليست هناك بيانات متاحة في الجدول",
            "loadingRecords": "جارٍ التحميل...",
            "processing": "جارٍ التحميل...",
            "lengthMenu": "أظهر _MENU_ مدخلات",
            "zeroRecords": "لم يعثر على أية سجلات",
            "info": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
            "infoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
            "infoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
            "search": "ابحث:",
            "paginate": {
                "first": "الأول",
                "previous": "السابق",
                "next": "التالي",
                "last": "الأخير"
            },
            "aria": {
                "sortAscending": ": تفعيل لترتيب العمود تصاعدياً",
                "sortDescending": ": تفعيل لترتيب العمود تنازلياً"
            },
            "select": {
                "rows": {
                    "_": "%d قيمة محددة",
                    "0": "",
                    "1": "1 قيمة محددة"
                },
                "1": "%d سطر محدد",
                "_": "%d أسطر محددة",
                "cells": {
                    "1": "1 خلية محددة",
                    "_": "%d خلايا محددة"
                },
                "columns": {
                    "1": "1 عمود محدد",
                    "_": "%d أعمدة محددة"
                }
            },
            "buttons": {
                "print": "طباعة",
                "copyKeys": "زر <i>ctrl<\/i> أو <i>⌘<\/i> + <i>C<\/i> من الجدول<br>ليتم نسخها إلى الحافظة<br><br>للإلغاء اضغط على الرسالة أو اضغط على زر الخروج.",
                "copySuccess": {
                    "_": "%d قيمة نسخت",
                    "1": "1 قيمة نسخت"
                },
                "pageLength": {
                    "-1": "اظهار الكل",
                    "_": "إظهار %d أسطر"
                },
                "collection": "مجموعة",
                "copy": "نسخ",
                "copyTitle": "نسخ إلى الحافظة",
                "csv": "CSV",
                "excel": "Excel",
                "pdf": "PDF",
                "colvis": "إظهار الأعمدة",
                "colvisRestore": "إستعادة العرض"
            },
            "autoFill": {
                "cancel": "إلغاء",
                "info": "مثال عن الملئ التلقائي",
                "fill": "املأ جميع الحقول بـ <i>%d&lt;\\\/i&gt;<\/i>",
                "fillHorizontal": "تعبئة الحقول أفقيًا",
                "fillVertical": "تعبئة الحقول عموديا"
            },
            "searchBuilder": {
                "add": "اضافة شرط",
                "button": [
                    "منشئ البحث"
                ],
                "clearAll": "ازالة الكل",
                "condition": "الشرط",
                "data": "المعلومة",
                "logicAnd": "و",
                "logicOr": "أو",
                "title": [
                    "منشئ البحث"
                ],
                "value": "القيمة",
                "conditions": {
                    "date": {
                        "after": "بعد",
                        "before": "قبل",
                        "between": "بين",
                        "empty": "فارغ",
                        "equals": "تساوي",
                        "not": "ليس",
                        "notBetween": "ليست بين",
                        "notEmpty": "ليست فارغة"
                    },
                    "moment": {
                        "after": "بعد",
                        "before": "قبل",
                        "between": "بين",
                        "empty": "فارغة",
                        "equals": "تساوي",
                        "not": "ليس",
                        "notBetween": "ليست بين",
                        "notEmpty": "ليست فارغة"
                    },
                    "number": {
                        "between": "بين",
                        "empty": "فارغة",
                        "equals": "تساوي",
                        "gt": "أكبر من",
                        "gte": "أكبر وتساوي",
                        "lt": "أقل من",
                        "lte": "أقل وتساوي",
                        "not": "ليست",
                        "notBetween": "ليست بين",
                        "notEmpty": "ليست فارغة"
                    },
                    "string": {
                        "contains": "يحتوي",
                        "empty": "فاغ",
                        "endsWith": "ينتهي ب",
                        "equals": "يساوي",
                        "not": "ليست",
                        "notEmpty": "ليست فارغة",
                        "startsWith": " تبدأ بـ "
                    }
                }
            },
            "searchPanes": {
                "clearMessage": "ازالة الكل"
            }
        }

    });

});
