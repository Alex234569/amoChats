<div class="center">
    <div class="centerGetInfo">
        <p id='boldText'>Теги для запроса:</p>
        <form action='' id='tagSearch' method = 'POST'></form>
        <label for='textareaGetInfo'></label><textarea id='textareaGetInfo' placeholder='Введите теги для поиска' rows='1' autofocus required form='tagSearch' name='tag'></textarea><br />
        <input type='submit' value='getInfo' form='tagSearch' name='button'>
    </div>

    <div class="centerAddInfo">
        <p id='boldText'>Информация для добавления:</p>
        <form action='' id='addInfo' method = 'POST'></form>
        <label for='textareaAddInfoQuestion'></label><textarea id='textareaAddInfoQuestion' placeholder='Вопрос' maxlength = '1000' required form='addInfo' name='question'></textarea><br />
        <label for='textareaAddInfoAnswer'></label><textarea id='textareaAddInfoAnswer' placeholder='Ответ' maxlength = '2000' required form='addInfo' name='answer'></textarea><br />
        <label for='textareaAddInfoTags'></label><textarea id='textareaAddInfoTags' placeholder='Теги' maxlength = '128' required form='addInfo' name='tag'></textarea><br />
        <label for='textareaAddInfoUrl'></label><textarea id='textareaAddInfoUrl' placeholder='Ссылка' maxlength = '255' form='addInfo' name='url'></textarea><br />
        <label>
            <input type="date" form='addInfo' name='addInfoDate'>
        </label><br />
        <input type='submit' value='addInfo' form='addInfo' name='button'>
    </div>
</div>