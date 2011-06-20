$j('#upload_image_button').click(function() {
formfield = $j('#upload_image').attr('name');
tb_show('', 'media-upload.php&type=image&TB_iframe=true');
return false;
});

window.send_to_editor = function(html) {
imgurl = $j('img',html).attr('src');
$j('#upload_image').val(imgurl);
tb_remove();
}