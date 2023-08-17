
// $(document).ready(function (){
$("form").submit(function (e) {
    e.preventDefault();
    let formData = new FormData(this);
    // console.log(formData)
    $.ajax({
        url: 'http://localhost/fine_renovation/index.php?action=register',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function (res) {
            console.log(res);
            var formData = JSON.parse(res);
            $('.form-control').removeClass("is-invalid");
            $('.invalid-feedback').html('');
            Object.keys(formData).forEach(function (key) {
                // console.log(key, formData[key]); // format
                $(`#${key}`).addClass('is-invalid')
                $(`#${key}1`).html(formData[key]);
            });
            if(formData.isadmin == 'yes'){
                window.location.href="http://localhost/fine_renovation/index.php";
            }else if(formData.isadmin == 'no'){
                window.location.href="http://localhost/fine_renovation/index.php?action=login";
            }

        }
    })
})
// })

