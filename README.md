# roistat_test_task
ЗАДАНИЕ:

Написать отправку заявок с сайта в AmoCRM.
1. Создать страницу и добавить на неё форму из 4-х полей: имя, email, телефон, цена. (Если есть опыт работы, сделать на Vue или ином JS-фреймворке. Если опыта их использования нет, то проблемой это не будет.)
2. Заявку из формы сайта создавать в AmoCRM, как сделку с прикрепленным к ней контактом. В контакт передавать имя, email и телефон. В сделку передавать цену. См. документацию по API https://developers.amocrm.ru/rest_api/ (авторизация должна быть выполнена через oauth2)
3. При написании бэкенда придерживаться парадигмы ООП и основных принципов программирования. (Важно показать умение правильно работать с классами)
http://amocrm.ru
https://developers.amocrm.ru/rest_api/

РЕАЛИЗАЦИЯ:

доступна на странице\
http://www.roistat.byethost3.com/index.php \
если не работает, значит надо обновить токен \
http://www.roistat.byethost3.com/api/refreshToken.php \
данные с amoCRM можно посмотреть на странице \
http://www.roistat.byethost3.com/api/dataFromAmocrm.php