.add_commentsform {
				border: 1px dashed #ccc;
				border-radius: 10px;
				background: #ECF1F2;
				display: block;
				width: 70%;
				padding-left: 30px;
				}
<div class="add_commentsform" id="comments_addform">
<p class="post_comment">Добавить Ваш комментарий:</p>
        <form action="comment.php" method="post" name="addcom" id="addcom" enctype="multipart/form-data" onsubmit="return false">
<p><label>Ваше имя: </label><input name="author" type="text" size="40" maxlength="30" placeholder="Введите имя"></p>
<p><label>Текст комментария:  <textarea name="text" cols="62" rows="6" placeholder="Текст комментария..."></textarea></label></p><p>Введите 7 цифр с картинки</p><p>
      <img src="kcaptcha?<?php echo session_name()?>=<?php echo session_id()?>" border="0" id="capcha-image" alt="Включите изображения в браузере" title="Робот не пройдет"><span style=" float: right; padding-right: 60%;">Если не виден  код пожалуйста <a href="javascript:void(0);" onclick="document.getElementById('capcha-image').src='kcaptcha?<?php echo session_name()?>=<?php echo session_id()?>' + Math.random();">обновите</a></span>
    <input style="margin-bottom:16px;" name="keystring" id="keystring" type="text" size="7" maxlength="7"></p>
    <input name="id" type="hidden" value="<? echo $id; ?>">
    <input name="guest" type="hidden" value="<? echo $guest; ?>">
<p> <input name="sub_com" type="submit" value="Комментировать" onclick="doLoad(document.getElementById('addcom'))"></p> 
         </form>
</div>