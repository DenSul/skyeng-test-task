### Ошибки
- Не правильно реализован паттерн декоратор.
- Отсутствие интерфейсов и тайп хинтинга.
- За валидацию должен отвечать объект реквеста, но не как сам контроллер. а еще лучше если объект реквеста будет уметь в цепочку обязанностей.
- Метод `action` в контроллере имеет скрытую зависимость `DecoratorManager`
- `$cache_key` формируется из массива с помощью `json_decode`, а значит может иметь неограниченную длину ключа. Это плохая идея, не только из-за занимаемой памяти, но так же и в связи с увеличением времени поиска определенного ключа в множестве в связи с дорогостоящим сравнением.
- Остались комментарии после дебага датапровайдера.
- Кэш сетится через отдельный метод, а не добавляется через декоратор кэша.
- Кэш не сохраняется.
- Ошибки в нейминге: `$isProdaction`, `CACE_SUFFIX`.
- Если нужно логировать ошибки на всех уровнях, тогда имеет смысл вынести в логгер декоратор и ловить все ошибки в том числе ошибки кэша. 
- Если нужно кэшить результаты запроса только на проде, тогда в кэш декораторе и должно это проверятся. 
- `array("categoryId" => $cat, '')` в массиве передается пустая строка.
- Хардкод рендера ответа в контроллере, необходим сервис по рендеру ответа. Например можно использовать паттерн `шаблоный метод` и необходимо отдавать нужные заголовки для ответа. В идеале psr-7
- Чтоб не описывать все зависимости, которые нужны для декоратора можно сделать фабрику и прокидывать только фабрику в контроллер. 
### От себя
- Мне не нравится использование напрямую курла и прокидыванием кредов. Лучше использовать csa/guzzle с отдельным файлом конфига кредов для конкретного клиента. Но тогда смысла в этих декораторах нет, ибо логгер и кэш в виде мидлвары там есть.
- Использовать PSR совместимый HTTP-клиент.
