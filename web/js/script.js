function playPause() {
    if ($("#video1").get(0).paused) {
        $("#video1")[0].play();
    } else {
        $("#video1")[0].pause();
    }
}
$(".form-control").on("change", function() {
    if ($("#username").val().length > 1 && $("#password").val().length > 6) {
        $("#login").removeClass("form-control").addClass("filled");
    }
});