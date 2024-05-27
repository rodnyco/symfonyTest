truncate table product;

insert into product values
    (1, 'Iphone', 100),
    (2, 'Наушники', 20),
    (3, 'Чехол', 10);


truncate table coupon;

insert into coupon values
    (1, 'Скидка 15%', 'P15', 'percent'),
    (2, 'Скидка 50%', 'P50', 'percent'),
    (3, 'Скидка 5 eur', 'F5', 'fixed'),
    (4, 'Скидка 20 eur', 'F20', 'fixed');


truncate table country_tax;

insert into country_tax values
    (1, 'IT', 22),
    (2, 'DE', 19),
    (3, 'GR', 24),
    (4, 'FR', 20);