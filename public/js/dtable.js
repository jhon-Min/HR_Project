// Csrf token
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": token.content,
        },
    });
} else {
    console.log("csrf token not found");
}

$.extend(true, $.fn.dataTable.defaults, {
    processing: true,
    serverSide: true,
    responsive: true,
    mark: true,
    language: {
        paginate: {
            next: '<i class="fa-solid fa-circle-arrow-right pg-next h5"></i>',
            previous: '<i class="fa-solid fa-circle-arrow-left pg-pre h5"></i>',
        },
        processing:
            '<div class="spinner-grow text-success" role="status"><span class="sr-only">.....Loading...</span></div>',
    },
    columnDefs: [
        {
            targets: "hidden",
            visible: false,
        },
        {
            targets: [0],
            class: "control",
        },
        {
            targets: "no-sort",
            orderable: false,
        },
    ],
});
