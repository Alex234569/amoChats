<?php


namespace app\views;


class ErrorCode
{
    public static function codes()
    {
    ?>
        <h2>Сведения о ошибках из кода системы</h2>

        <div class="errorCodeBlock">
            <div class="littleHeader">Common HTTP error codes</div><br />
            <div class="littleResult">
                NO_CONTENT = 204; // Нет данных<br />
                BAD_REQUEST = 400; // Неверная структура массива передаваемых данных, либо неверные идентификаторы кастомных полей<br />
                PAYMENT_REQUIRED = 402; // Необходимо оплатить функционал<br />
                ACCOUNT_BLOCKED = 403; // Аккаунт заблокирован, за неоднократное превышение количества запросов в секунду<br />
                METHOD_NOT_ALLOWED = 405; // Некорректный метод запроса (GET вместо POST и наоборот)<br />
                REQUEST_ENTITY_TOO_LARGE = 413; // Тело запроса слишком большое<br />
                UNPROCESSABLE_ENTITY = 422; // Запрос корректен, но его невозможно выполнить<br />
                TOO_MANY_REQUESTS = 424; // Превышено допустимое количество запросов в секунду<br />
                SERVICE_UNAVAILABLE = 503; //Сервис недоступен<br />
            </div>
        </div>

        <div class="errorCodeBlock">
            <div class="littleHeader">Common Functional error codes</div><br />
            <div class="littleResult">
                NOT_AVAILABLE = 425; // Функционал недоступен<br />
                FUNCTIONAL_DISABLED = 426; // Функционал выключен<br />
                ADMIN_ONLY = 244; // Только администратор<br />
                UNDEFINED_METHOD = 104; //Метод неизвестен<br />
            </div>
        </div>

        <div class="errorCodeBlock">
            <div class="littleHeader">Authorization</div><br />
            <div class="littleResult">
                ACCOUNT_NOT_FOUND = 101;<br />
                INVALID_LOGIN_OR_PASSWORD = 110;<br />
                INVALID_CAPTCHA_CODE = 111;<br />
                USER_NOT_IN_ACCOUNT = 112;<br />
                IP_FILTER_ACCESS_DENIED = 113;<br />
                DEACTIVATED_BY_MONITORING = 114;<br />
                INVALID_SESSION_ID = 115;<br />
            </div>
        </div>

        <div class="errorCodeBlock">
            <div class="littleHeader">Leads</div><br />
            <div class="littleResult">
                INCORRECT_LOSS_REASON_ID = 241;<br />
                INCORRECT_STATUS_FOR_LOSS_REASON = 242;<br />
            </div>
        </div>

        <div class="errorCodeBlock">
            <div class="littleHeader">Notifications</div><br />
            <div class="littleResult">
                EMPTY_NOTIFICATIONS_ARRAY = 251;<br />
                NOTIFICATION_IS_NOT_ARRAY = 252;<br />
                INVALID_NOTIFICATION_TYPE = 253;<br />
                EMPTY_NOTIFICATION_TEXT = 254;<br />
                EMPTY_NOTIFICATION_DATE = 255;<br />
                EMPTY_NOTIFICATION_ID = 256;<br />
                INVALID_NOTIFICATIONS_FILTER = 257;<br />
            </div>
        </div>

        <div class="errorCodeBlock">
            <div class="littleHeader">Chats</div><br />
            <div class="littleResult">
                INVALID_CHAT_ID = 260;<br />
                INCORRECT_USER_ID = 261;<br />
                NO_DATA_FOR_PROCESS = 262;<br />
                ENTITY_NOT_FOUND = 263;<br />
                CHAT_ALREADY_EXISTS = 264;<br />
                AMOJO_USER_NOT_REGISTERED = 265;<br />
                AMOJO_ACCOUNT_NOT_REGISTERED = 266;<br />
                AMOJO_API_ERROR = 267;<br />
                INCORRECT_CHAT_TYPE = 268;<br />
                INCORRECT_USERS_COUNT = 269;<br />
                INCORRECT_CHATS_FILTER = 270;<br />
            </div>
        </div>

        <div class="errorCodeBlock">
            <div class="littleHeader">Bots</div><br />
            <div class="littleResult">
                AMOJO_BOT_NOT_REGISTERED = 271;<br />
            </div>
        </div>

        <div class="errorCodeBlock">
            <div class="littleHeader">Users</div><br />
            <div class="littleResult">
                INCORRECT_USER_EMAIL = 275;<br />
                INCORRECT_USER_DATA = 276;<br />
                USER_ENTITY_NOT_FOUND = 277;<br />
                EMPTY_CHAT_MESSAGE = 278;<br />
            </div>
        </div>

        <div class="errorCodeBlock">
            <div class="littleHeader">Catalogs</div><br />
            <div class="littleResult">
                NOT_ADDED = 280;<br />
                NOT_DELETED = 281;<br />
                NOT_FOUND = 282;<br />
                ITEM_IS_EMPTY = 283;<br />
                INVALID_ITEM_FORMAT = 284;<br />
                REQUIRED_FIELD_MISSED = 285;<br />
                UNEXPECTED_VALUE = 286;<br />
                NOTHING_TO_DO = 287;<br />
                RIGHTS_DENIED = 288;<br />
                MULTIPLE_LINK_IS_NOT_ALLOWED = 289;<br />
            </div>
        </div>

        <div class="errorCodeBlock">
            <div class="littleHeader">Subscriptions</div><br />
            <div class="littleResult">
                SUBSCRIPTION_IS_NOT_ARRAY = 291;<br />
                EMPTY_SUBSCRIPTION_TEXT = 292;<br />
                INVALID_SUBSCRIPTION_FILTER  = 293;<br />
                INCORRECT_USER = 294;<br />
                INCORRECT_GROUP = 295;<br />
                INCORRECT_SUBSCRIPTION_DATA = 296;<br />
                INVALID_ENTITY_TYPE = 297;<br />
                INVALID_ENTITY_ID = 298;<br />
                UNKNOWN_SUBSCRIPTION_ERROR = 299;<br />
                EMPTY_SUBSCRIPTION_ARRAY = 300;<br />
            </div>
        </div>

        <div class="errorCodeBlock">
            <div class="littleHeader">Origins</div><br />
            <div class="littleResult">
                INCORRECT_ORIGINS_DATA = 303;<br />
                EMPTY_ORIGINS_FILE_TO_ICON = 304;<br />
                INVALID_ORIGINS_FILE_TYPE = 305;<br />
                ORIGINS_FILE_TOO_LARGE = 306;<br />
                ORIGINS_TMP_FILE_NOT_FOUND = 307;<br />
                ORIGINS_FILE_GET_CONTENTS_ERROR = 308;<br />
                ORIGINS_ACCESS_ERROR = 309;<br />
            </div>
        </div>

        <div class="errorCodeBlock">
            <div class="littleHeader">Support (log)</div><br />
            <div class="littleResult">
                INCORRECT_SUPPORT_ACTION = 311;<br />
                INCORRECT_SUPPORT_LINE = 312;<br />
                SUPPORT_ACCESS_ERROR = 313;<br />
                INCORRECT_SUPPORT_DATA = 314;<br />
            </div>
        </div>

        <div class="errorCodeBlock">
            <div class="littleHeader">Support chats</div><br />
            <div class="littleResult">
                NO_CONFIG = 315;<br />
                NO_ACCOUNT_IDS = 316;<br />
                NO_USER_ID = 317;<br />
                NO_USER_NAME = 318;<br />
            </div>
        </div>

        <div class="errorCodeBlock">
            <div class="littleHeader">forms</div><br />
            <div class="littleResult">
                TOO_LARGE_FILE = 319;<br />
                INVALID_FILE_TYPE = 320;<br />
                FILE_COULD_NOT_BE_UPLOAD = 321<br />;
                FILES_LIMIT_EXCEEDED = 322;<br />
                INVALID_SETTINGS = 325;<br />
            </div>
        </div>

        <div class="errorCodeBlock">
            <div class="littleHeader">notes</div><br />
            <div class="littleResult">
                RIGHTS_DENIED_NOTES_ADD = 244;<br />
                ELEMENT_ENTITY_NOT_FOUNT = 226;<br />
                NOTES_EMPTY_ARRAY = 218;<br />
                NOTES_TYPE_REQUIRE = 221;<br />
                NOTES_EMPTY_REQUEST = 222;<br />
                NOTES_INCORRECT_METHOD = 223;<br />
                NOTES_UPDATE_EMPTY_ARRAY = 224;<br />
                NOTES_UPDATE_NOT_FOUND = 225;<br />
                NOTES_UNSUPPORTED_NOTE_TYPE = 323;<br />
            </div>
        </div>

        <div class="errorCodeBlock">
            <div class="littleHeader">contacts</div><br />
            <div class="littleResult">
                CONTACTS_EMPTY_ARRAY = 201;<br />
                CONTACTS_NOT_PRIVILEGES = 202;<br />
                CONTACTS_CUSTOM_FIELD_ERROR = 203;<br />
                CONTACTS_CUSTOM_FIELD_NOT_FOUND = 204;<br />
                CONTACTS_NOT_CREATED = 205;<br />
                CONTACTS_EMPTY_REQUEST = 206;<br />
                CONTACTS_INCORRECT_METHOD = 207;<br />
                CONTACTS_UPDATE_EMPTY_ARRAY = 208;<br />
                CONTACTS_REQUIRE_PARAMS = 209;<br />
                CONTACTS_UPDATE_CUSTOM_FIELD_ERROR = 210;<br />
                CONTACTS_UPDATE_CUSTOM_FIELD_NOT_FOUND = 211;<br />
                CONTACTS_NOT_UPDATED = 212;<br />
                CONTACTS_LIST_SEARCH_ERROR = 219;<br />
            </div>
        </div>

        <div class="errorCodeBlock">
            <div class="littleHeader">leads</div><br />
            <div class="littleResult">
                LEADS_EMPTY_ARRAY = 213;<br />
                LEADS_EMPTY_REQUEST = 214;<br />
                LEADS_INCORRECT_REQUEST = 215;<br />
                LEADS_UPDATE_EMPTY_ARRAY = 216;<br />
                LEADS_REQUIRE_PARAMS = 217;<br />
                LEADS_INCORRECT_ID_CUSTOM_FIELD = 240;<br />
            </div>
        </div>

        <div class="errorCodeBlock">
            <div class="littleHeader">tasks</div><br />
            <div class="littleResult">
                TASKS_EMPTY_ARRAY = 227;<br />
                TASKS_EMPTY_REQUEST = 228;<br />
                TASKS_INCORRECT_METHOD = 229;<br />
                TASKS_UPDATE_EMPTY_ARRAY = 230;<br />
                TASKS_UPDATE_NOT_FOUND = 231;<br />
                TASKS_INCORRECT_ELEMENT = 232;<br />
                TASKS_INCORRECT_CONTACT_ID = 233;<br />
                TASKS_INCORRECT_LEAD_ID = 234;<br />
                TASKS_ELEMENT_NOT_SPECIFIED = 235;<br /><br />
                TASKS_CONTACT_ELEMENT_ID_NOT_FOUND = 236;<br />
                TASKS_LEAD_ELEMENT_ID_NOT_FOUND = 237;<br />
                TASKS_NO_VALUE = 238;<br />
            </div>
        </div>

        <div class="errorCodeBlock">
            <div class="littleHeader">pipelines</div><br />
            <div class="littleResult">
                DOUBLE_VALUE_SORT = 239;<br />
                PIPELINE_NOT_FOUND = 243;<br />
            </div>
        </div>

        <div class="errorCodeBlock">
            <div class="littleHeader">custom fileds</div><br />
            <div class="littleResult">
                CUSTOM_FIELD_ERROR = 203;<br />
            </div>
        </div>

        <div class="errorCodeBlock">
            <div class="littleHeader">Calls</div><br />
            <div class="littleResult">
                CALLS_INCORRECT_DIRECTION = 258;<br />
            </div>
        </div>

        <div class="errorCodeBlock">
            <div class="littleHeader">Links</div><br />
            <div class="littleResult">
                LINKS_EMPTY_REQUEST = 330; // Пустой запрос<br />
                LINKS_EMPTY_FILTER = 331; // Не указаны параметры фильтрации<br />
                LINKS_EMPTY_FROM_PARAM = 332; // Не указан from<br />
                LINKS_UNSUPPORTED_FROM_PARAM = 333; // Не поддержвиваемый тип from<br />
                LINKS_INVALID_FILTER = 334; // Не корректный фильтр<br />
            </div>
        </div>

        <div class="errorCodeBlock">
            <div class="littleHeader">widgets</div><br />
            <div class="littleResult">
                WIDGETS_SOURCES_EMPTY_WIDGET_CODE = 341;<br />
                WIDGETS_SOURCES_INVALID_WIDGET_CODE = 342;<br />
                WIDGETS_SOURCES_EMPTY_SERVICES_LIST = 343;<br />
                WIDGETS_SOURCES_SOURCE_NOT_FOUND = 344;<br />
                EXPORT_RIGHTS_DENIED = 350;<br />
            </div>
        </div>
        <?php
    }
}