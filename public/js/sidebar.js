jQuery(function ($) {
    $(".sidebar-dropdown > a").click(function () {
        $(".sidebar-submenu").slideUp(200);
        if ($(this).parent().hasClass("active")) {
            $(".sidebar-dropdown").removeClass("active");
            $(this).parent().removeClass("active");
        } else {
            $(".sidebar-dropdown").removeClass("active");
            $(this).next(".sidebar-submenu").slideDown(200);
            $(this).parent().addClass("active");
        }
    });

    document.addEventListener("click", (e) => {
        if (document.getElementById("show-sidebar").contains(e.target)) {
            $(".page-wrapper").addClass("toggled");
        } else if (!document.getElementById("sidebar").contains(e.target)) {
            $(".page-wrapper").removeClass("toggled");
        }
    });

    $("#close-sidebar").click(function () {
        $(".page-wrapper").removeClass("toggled");
    });
    $("#show-sidebar").click(function () {
        $(".page-wrapper").addClass("toggled");
    });

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
});
