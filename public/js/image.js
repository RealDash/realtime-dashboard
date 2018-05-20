$("#avatar-icon").click(function(){
    $("#avatar").trigger('click');
});

$("#avatar").change(function(){
    var files = event.target.files;
    var file = new FormData();
    console.log(files);
    $.each(files, function(key, value) {
        file.append('avatar', value);
    });
    console.log(file);
    axios.post('/avatar/upload',file)
        .then(response =>{
            location.reload();
        })
        .catch(error => {
            console.log(error);
        });
});