# review
Модуль «Обратная связь»
Условный модуль «Обратная связь», в котором :
1. производится валидация данных на front:
- поле name валидируется на наличие и количество символов (не менее 2 символов и не более 96);
- поле phone валидируется на наличие;
- поле email валидируется на наличие и соответствие паттерну для данного типа поля;
- поле quection валидируется на наличие.
2. Данные отправляются посредством AJAX.
3. Производится валидация полученных данных на back на соответствие тем же условиям, которые указаны для валидации на front.
4. При успешной валидации данные сохраняются в БД review в таблице review, которая имеет следующую структуру:
CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `name` varchar(240) NOT NULL,
  `phone` varchar(240) NOT NULL,
  `email` varchar(240) NOT NULL,
  `question` text NOT NULL,
  `review_date` varchar(240) NOT NULL
)
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`);
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
5.При успешном сохранении пользователю выводится сообщение "Вопрос сохранен", при не успешном - сообщение об ошибке.
6.Полученные сообщения можно просмотреть в Админпанели.
7.Админпанель состоит из страницы авторизации login.php (должен быть указан логин и пароль). 
Данные пользователя для авторизации хранятся в таблице users, которая имеет следующую структуру:
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `login` varchar(240) NOT NULL,
  `password` varchar(240) NOT NULL
)
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
8. Вывод данных по модулю (запросы на обратную связь) осуществляется в табличном виде на странице review.php.
