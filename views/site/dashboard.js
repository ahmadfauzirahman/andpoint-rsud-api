$(document).ready(function () {
    setInterval(function () {
        console.log("test");
        $.pjax.reload({
            container: '#pjax-absensi',
            timeout: false
        });
    }, 3000);
})