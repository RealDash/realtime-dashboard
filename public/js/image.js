$("#avatar-icon").click(function(){
    $("#avatar").trigger('click');
});

$("#avatar").change(function(){
    var files = event.target.files;
    var file = new FormData();
    $(".avatar-view").LoadingOverlay('show');
    console.log(files);
    $.each(files, function(key, value) {
        file.append('avatar', value);
    });
    
    
    axios.post('/avatar/upload',file)
        .then(response =>{
            $(".avatar-view").LoadingOverlay('hide');
            location.reload();
        })
        .catch(error => {
            $(".avatar-view").LoadingOverlay('hide');
            console.log(error);
        });
});