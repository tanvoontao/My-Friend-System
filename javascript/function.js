// help to preview image before upload
$(".upload_profile_area").on("click", function(){
    let area = $(this).closest(".col-md-4");
    let area2 = $(this);
    let img_Input = area.find("input");
    area.addClass("active");
    img_Input.click() // click the input file type

    let icon_Input = $(".icon", this);
    let text_Input = $(".dragText", this);

    icon_Input.css("display", "none");
    text_Input.css("display", "none");


    img_Input.change(function (){
        if (this.files && this.files[0]){
            var reader = new FileReader(); // web API to help preview image
            reader.onload = function (e){
                area.find(".img_thumbnail").remove();
                area2.append($('<img class="img_thumbnail" src="'+e.target.result+'"/>'));
            }
        }
        reader.readAsDataURL(this.files[0]);

    });
});

