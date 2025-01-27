const fileInput = document.getElementById("id_course_image");
const previewImg = document.getElementById("preview_img_course");

fileInput.addEventListener("change", function (event) {
  const fileImg = event.target.files[0];

  if (fileImg && fileImg.type.startsWith("image/")) {
    const readerImg = new FileReader();

    readerImg.onload = function (element) {
      previewImg.src = element.target.result;
    };

    readerImg.readAsDataURL(fileImg);
  } else {
    previewImg.src = "";
  }
});
