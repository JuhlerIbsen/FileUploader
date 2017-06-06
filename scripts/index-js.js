/**
 * Created by michael on 06-06-2017.
 */
/**
 * Set information about the file in the paragraphs.
 */
function getInfo() {
    var upload = document.getElementById("upload").files[0];
    var nameText = document.getElementById("name");
    var sizeText = document.getElementById("size");
    var typeText = document.getElementById("type");

    nameText.innerHTML = upload.name;
    sizeText.innerHTML = upload.size + " bytes";
    typeText.innerHTML = upload.type;
}