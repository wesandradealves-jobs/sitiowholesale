Japan Nationa Postal Code List in Roman
=======================================

Files
-----
* readme.txt: this file
* roman.txt: contains all records, roman characters only.
* roman2.txt: contains all records, roman, hiragana, kanji.


Base Data
---------
The database is based on ken_all.zip which Japan Post Service Co., Ltd. has been publishing for public.

You can download it from this direct link.

http://www.post.japanpost.jp/zipcode/dl/kogaki/zip/ken_all.zip

Japan Post Service Co., Ltd.'s English page is here. http://www.post.japanpost.jp/english/index.html


Roman conversion
----------------
Above data file has Japanese kataana value. We convert it into roman programaticaly.
Roman representation in Japanese has some ways. Kunrei, Hepburn etc.
We use modified Hepburn system of romanization.


Format conversion
-----------------
Original data file has some ugly specs.
For example, one town divided into two or three rows, because of character length.
In our conversion that is merged into one row.
There is four another specs, but its too difficult to explain in english for us.


File format
-----------
* First line is title
* Column seperator: Tab
* Record seperator: CR+LF
* Text encoding: UTF-8

* roman.txt Columns
  1. row number
  2. postal code
  3. prefecture code
  4. city code
  5. town
  6. city
  7. prefecture
  8. area

* roman2.txt Columns
   1. row number
   2. postal code
   3. prefecture code
   4. city code
   5. town
   6. city
   7. prefecture
   8. area
   9. town_kana
  10. city_kana
  11. prefecture_kana
  12. area_kana
  13. town_kanji
  14. city_kanji
  15. prefecture_kanji
  16. area_kanji


* Town column has some special values:
  1. "*" means, when there is not a mention.
  2. "-" means, in case that street numbers come after the city.

* Area division has some alternative ways.


Author
------
Fabrice Co. https://www.fabrice.co.jp/


Version
-------
version 18.01(Sun, 18 Feb 2018 18:20:33 +0900)


