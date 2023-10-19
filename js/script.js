window.addEventListener("load", function () {
    function sendData() {
        btn.disabled = true;

        const XHR = new XMLHttpRequest();
        const FD = new FormData(form);

        XHR.open("POST", "/api/dataProcessor.php");
        XHR.send(FD);

        XHR.addEventListener("load", function (event) {
            console.log("Кнопка нажата");
            console.log(XHR.response);
            let json = JSON.parse(XHR.response);
            console.log(json['result']);
            btn.disabled = false;
        });

        XHR.addEventListener("error", function (event) {
            alert("Oops! Something went wrong.");
        });

    }


    const form = document.getElementById('form');
    const btn = document.getElementById('sendButton');

    form.addEventListener("submit", function (event) {
        event.preventDefault();
        sendData();
    });
});