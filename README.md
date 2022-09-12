# Задание: создание небольшого web ресурса Laravel
# _Сущности:_
## Продавец
Предоставляет ценовые предложение на товары  
Характеристики: **наименование**, **список ценовых предложений на товары**
## Товар
Некоторый продаваемый объект, например, «ssd диск samsung t7 1TB». Один товар может продаваться любым количеством продавцов  
Характеристики: **наименование**, **описание**, **изображение товара**, **список ценовых предложений от разных продавцов**
## Предложение
Конкретное предложение по цене для товара от продавца.  
Характеристики: **товар, который предлагается**; **цена за единицу товара**; **количество товара в наличии**; **продавец, разместивший предложение**
# _HTTP точки входа:_
## GET /api/offers
**Список предложений** в соответствии с переданными фильтрами.

Данные возвращаются в формате **json**;  
требований на структуру нет;  
добавлять свои дополнительные параметры к точке входа можно, если необходимость этого аргументирована.

Необходимо реализовать следующие **фильтры**:
(если фильтры не переданы, фильтрацию не осуществлять)
- наименование товара (наименования товаров, по которым сделаны предложения, должны точно совпадать с переданной строкой)
- часть наименования товара (наименования товаров, по которым сделаны предложения, должны точно совпадать с переданной строкой)
- максимальная цена за единицу товара

Необходимо реализовать следующие **сортировки** (если сортировки не переданы, сортировку не осуществлять):
- цена по возрастанию (сначала предложения с наименьшей ценой за единицу товара)
- по новизне (сначала новые предложения)

Возвращаемые поля (для каждого предложения):
имя товара,
описание товара,
ссылка на изображение товара,
цена за единицу товара,
количество товара в наличии,
имя продавца.

>Не обязательное задание (делается только если сразу появился вариант реализации с малыми сроками):  
Реализовать **группировку** по товарам при передаче дополнительного параметра (`view=groups`). В этом случае возвращается не список предложений, а список товаров, к каждому из которых приписан список его предложений.  
При группировке предложений учитывать фильтры и сортировки (например, предложения с разными ценами не могут быть объединены в одну группу, если ведется сортировка по ценам; в этом случае один товар будет в списке несколько раз)

## DELETE /api/offers/{id}
Отметить предложение на удаление (не удалять физически). Авторизация должна быть; в любом удобном виде (например, по токену продавца, который выпускается в процессе заполнения БД; регистрацию, аутентификацию и т.д. не нужна/не обязательна).
>Дополнительное задание: отмеченное таким образом предложение должно быть физически удалено через сутки, если не было восстановлено. Реализация любым способом.

## POST /api/offers/{id}
Восстановить отмеченное на удаление предложение. На тело ограничений нет.

## GET /api/products/{id}/sellers
Список всех продавцов, которые предлагают данный товар
Данные возвращаются в формате json;  
требований на структуру нет; добавлять свои дополнительные фильтры/параметры к точке входа можно, если необходимость этого аргументирована;  
для каждого продавца возвращается его имя.


>### GET /products/{id}/sellers  
> Не обязательная точка входа. Аналогично предыдущей точке входа, но данные возвращаются в виде сформированной html страницы. Ограничений на верстку нет, что-то простое. Формирование через view, blade.

# _Заполнение БД:_
Для создания таблиц используется «Migrations».  
Для заполнения БД тестовыми данными используется «Seeding».  
Для задания наименований и чисел можно использовать Faker/rand/Str::random или любой другой способ.Требования к БД для проверки (генерация должна создавать такую БД):

Продавцы:
- минимальное количество записей 1000000 (1 млн) `+`
- каждый продавец должен предлагать не менее 10000 товаров (10 тысяч) (`+` только для 10)
- должен быть хотя бы один продавец, который предлагает не менее 100000 товаров (100 тысяч) (`+` только 100)
- должен быть один продавец исключение, который не предлагает товаров (`+`)

Товары:
- минимальное количество записей 1000000 (1 млн) `+`
- каждый товар должен быть предложен не менее чем 10000 продавцов (10 тысяч) (`+` только для 10)
- хотя бы один товар должен быть предложен 100000 продавцов (100 тысяч) (`+` только для 10)
- должен быть один товар исключение, который не предлагается ни одним продавцом (`+`)

___

<dl>
<dt>Заливание предложений (offers)</dt> 
<dd>Для 10 000 000 записей занимает 16.7 минут (1 продукт имеет 10 продавцов, 1 продавец имеет 10 продуктов).</dd>
<dd>Для 10 000 000 000 записей (это по условию 1 продавец имеет 10 000 продуктов, 1 продукт имеет 10 000 продавцов) потребуется 278 часов (быстрее пока не знаю как можно сделать)</dd>
</dl>
