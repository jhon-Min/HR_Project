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

    $("#logoutBtn").click(function (e) {
        e.preventDefault();
        $("#logout-form").submit();
    });

    // $("#back").click(function (e) {
    //     e.preventDefault();
    //     window.history.go(-1);
    //     return false;
    // });
});
