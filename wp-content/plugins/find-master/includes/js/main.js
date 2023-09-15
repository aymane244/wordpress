$(document).ready(function() {
    let infoArea = $("#show_logo_university");
    $("#logo_university").change(function(e) {
        const input = e.target;
        const fileName = input.files[0].name;
        const extension = fileName.split('.').pop();
        if (extension != "png" && extension != "jpg" && extension != "jpeg") {
            infoArea.html('');
            alert('Veuillez insérer un fichier de type jpg, jpeg, png. Le fichier inséré est de type ' + extension);
            $('#show_logo').removeClass('show_logo');
        } else {
            infoArea.text(fileName);
            const reader = new FileReader();
            reader.onload = function(e) {
                let uploaded_image = e.target.result;
                $('#show_logo').css('background-image', 'url(' + uploaded_image + ')');
                $('#show_logo').addClass('show_logo');
            };
            reader.readAsDataURL(input.files[0]);
        }
    });
});