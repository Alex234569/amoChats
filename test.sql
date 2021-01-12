




SELECT main.question, main.answer, main.url, main.date 
FROM tegs 
INNER JOIN compound on tegs.id_teg = compound.id_teg 
INNER JOIN main on compound.id_main = main.id_main 
WHERE tegs.teg = 'животное'


SELECT main.question, main.answer, main.url, main.date, tegs.teg FROM main INNER JOIN compound ON main.id_main = compound.id_main INNER JOIN tegs ON compound.id_teg = tegs.id_teg WHERE tegs.teg = 'животное' OR tegs.teg = 'говорить';
SELECT * FROM tegs WHERE teg = 'говорить';

SELECT id_main FROM compound WHERE id_teg IN (1, 2) GROUP BY id_main HAVING (COUNT(*) = 2);
SELECT compound.id_main FROM compound WHERE compound.id_teg IN (1, 2) GROUP BY compound.id_main HAVING (COUNT(*) = 2);
SELECT compound.id_main FROM compound LEFT JOIN tegs ON compound.id_teg = tegs.id_teg WHERE tegs.teg IN ('животное', 'говорить') GROUP BY compound.id_main HAVING (COUNT(*) = 2);
SELECT main.question, main.answer, main.url, main.date FROM main LEFT JOIN compound ON main.id_main = compound.id_main LEFT JOIN tegs ON compound.id_teg = tegs.id_teg WHERE tegs.teg IN ('животное', 'говорить') GROUP BY main.id_main HAVING (COUNT(*) = 2);
/*  COUNT(*) = количество аргументов в IN  */
SELECT * FROM tegs WHERE teg = 'животное' OR teg = 'говорить';


INSERT INTO `main` (`id_main`, `question`, `answer`, `url`, `date`) VALUES (NULL, 'кто сказал му', 'корова', 'http korova and co', '2010-12-20'), 
    (NULL, 'как рисовать елку', 'красиво', 'http green tree', '2021-01-01');
    (NULL, 'как рисовать елку', 'красиво', 'http green tree', '2021-01-01');
INSERT INTO `tegs` (`id_teg`, `teg`) VALUES (NULL, 'животное'), (NULL, 'говорить');
INSERT INTO `compound` (`id_main`, `id_teg`) VALUES ('1', '1'), ('2', '2');





create table compound
(
    id_main int,
    id_teg int,
    FOREIGN KEY (id_main) REFERENCES main (id_main) ON DELETE CASCADE,
    FOREIGN KEY (id_teg) REFERENCES tegs (id_teg) ON DELETE CASCADE
)


INSERT INTO `main` (`id_main`, `question`, `answer`, `url`, `date`) VALUES 
    (NULL, 'кто сказал му', 'корова', 'http korova and co', '2010-12-20'), (NULL, 'кто построил дом', 'человек', 'http homeForEveryone', '2008-12-20'), 
    (NULL, 'создатель', 'я', 'http me', '2020-03-19'), (NULL, 'как писать', 'ручкой', 'http freePen', '2018-11-20'),
    (NULL, 'кто орал', 'начальник', 'http nach', '2021-01-03'), (NULL, 'как рисовать елку', 'красиво', 'http green tree', '2021-01-01');
INSERT INTO `tegs` (`id_teg`, `teg`) VALUES (NULL, 'животное'), (NULL, 'говорить'), (NULL, 'человек'), (NULL, 'писать'), (NULL, 'елка');
INSERT INTO `compound` (`id_main`, `id_teg`) VALUES ('1', '1'), ('1', '2'), ('2', '1'), ('2', '3'), ('3', '3'), ('4', '4'), ('5', '1'), ('5', '2'), ('5', '3'), ('6', '4'), ('6', '3'), ('6', '5');
