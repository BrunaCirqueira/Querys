<?php
set_time_limit(false);

$myArray = array(1310796,1313168,1313199,1314814,1324190,1398743,1399783,1400493,1410301,1410488,1589057,1590211,1590742,1590922,1591552,1594629,1596176,1597023,1598172,1598229,1600138,1600638,1602099,1604072,1605456,1605533,1605861,1605865,1605866,1605870,1605872,1605877,1605881,1605883,1605889,1605890,1605891,1605894,1605901,1605906,1605907,1605910,1605915,1605924,1605928,1605931,1605933,1605937,1605938,1605942,1605944,1605947,1605952,1605953,1605954,1605955,1605956,1605963,1605964,1605965,1605966,1605968,1605969,1606145,1606385,1606527,1606629,1606682,1607650,1607651,1607652,1608988,1610343,1610344,1610345,1610346,1610365,1610366,1610367,1610368,1610369,1610431,1610953,1611669,1615137,1615472,1616061,1617429,1618157,1621906,1622911,1622915,1626230,1627095,1627556,1628036,1636880,1636881,1636882,1637722,1640246,1641340,1641929,1641930,1641931,1642723,1644457,1647698,1649449,1651682,1655257,1656112,1656357,1657358,1661994,1664512,1664598,1664681,1664759,1664974,1665278,1665358,1665439,1665600,1665903,1665981,1666056,1666210,1666282,1666355,1666430,1666506,1666661,1666742,1666819,1667041,1667121,1667199,1667276,1667362,1667445,1667527,1667758,1667836,1667913,1668291,1668362,1668580,1668740,1668819,1668897,1669047,1669109,1669116,1669197,1669277,1669357,1669437,1669670,1669757,1669905,1670135,1670285,1670364,1670442,1670525,1670607,1670679,1670828,1670904,1671057,1671131,1671209,1671286,1671363,1671657,1671735,1671889,1671969,1672116,1672271,1672807,1672879,1672950,1673026,1673100,1673256,1673334,1673409,1673488,1673563,1673732,1673883,1674032,1674185,1674258,1674332,1674482,1674554,1674628,1674704,1674851,1674922,1675142,1675360,1675435,1675513,1675587,1675730,1675806,1675881,1676092,1676244,1676316,1676465,1676534,1676678,1676749,1676831,1676899,1677115,1677188,1677263,1677495,1677786,1677924,1677998,1678144,1678177,1678214,1678285,1678433,1678514,1678667,1678738,1678948,1679023,1679096,1679175,1679247,1679321,1679463,1679676,1679692,1679733,1679820,1680119,1680234,1680334,1680339,1680415,1680489,1680565,1680595,1680604,1680640,1680649,1680710,1680786,1680824,1680846,1680935,1681013,1681020,1681149,1681216,1681223,1681258,1681272,1681300,1681325,1681350,1681355,1681356,1681364,1681498,1681512,1681560,1681590,1681661,1681721,1681736,1681754,1681760,1681805,1681826,1681833,1681839,1681842,1681849,1681887,1682020,1682079,1682095,1682126,1682160,1682228,1682237,1682256,1682341,1682366,1682376,1682414,1682443,1682444,1682513,1682516,1682585,1682586,1682617,1682653,1682658,1682665,1682696,1682802,1682858,1682861,1682873,1682951,1682984,1682994,1683019,1683085,1683113,1683158,1683186,1683247,1683268,1683308,1683370,1683435,1683462,1683584,1683687,1683735,1683779,1683806,1683869,1683876,1684022,1684026,1684035,1684080,1684097,1684171,1684198,1684241,1684255,1684263,1684318,1684386,1684530,1684550,1684560,1684597,1684603,1684669,1684741,1684778,1684789,1684829,1684887,1685030,1685060,1685235,1685254,1685256,1685272,1685284,1685313,1685327,1685376,1685540,1685613,1685638,1685668,1685738,1685766,1685835,1685877,1685878,1685919,1685961,1685974,1686239,1686267,1686310,1686380,1686381,1686463,1686466,1686473,1686483,1686485,1686513,1686531,1686667,1686671,1686681,1686758,1686765,1686899,1687008,1687048,1687120,1687186,1687203,1687328,1687343,1687407,1687494,1687520,1687551,1687575,1687626,1687630,1687726,1687775,1687803,1687845,1687891,1687895,1687919,1687956,1687989,1688058,1688173,1688186,1688201,1688202,1688234,1688242,1688326,1688337,1688343,1688390,1688418,1688442,1688530,1688554,1688624,1688672,1688686,1688692,1688693,1688698,1688701,1688706,1688712,1688719,1688724,1688753,1688758,1688771,1688856,1688969,1688970,1689015,1689017,1689028,1689075,1689188,1689195,1689222,1689257,1689294,1689295,1689313,1689317,1689330,1689337,1689364,1689368,1689392,1689436,1689509,1689532,1689533,1689571,1689611,1689668,1689758,1689795,1689850,1689869,1689884,1689912,1689996,1690012,1690057,1690060,1690123,1690125,1690144,1690156,1690224,1690232,1690264,1690288,1690296,1690339,1690353,1690388,1690420,1690421,1690445,1690466,1690509,1690528,1690533,1690535,1690538,1690551,1690576,1690592,1690642,1690723,1690749,1690793,1690801,1690850,1690862,1690927,1690940,1690959,1690975,1691045,1691078,1691085,1691093,1691173,1691251,1691269,1691279,1691313,1691435,1691478,1691493,1691520,1691528,1691534,1691540,1691543,1691552,1691571,1691572,1691592,1691603,1691608,1691616,1691627,1691655,1691658,1691660,1691689,1691698,1691705,1691714,1691724,1691747,1691771,1691777,1691783,1691790,1691794,1691813,1691822,1691833,1691842,1691846,1691861,1691866,1691869,1691897,1691900,1691906,1691917,1691918,1691929,1691931,1691946,1691949,1691955,1691974,1691997,1692006,1692008,1692017,1692029,1692048,1692051,1692059,1692063,1692069,1692096,1692102,1692110,1692122,1692126,1692127,1692136,1692137,1692139,1692151,1692153,1692161,1692170,1692178,1692186,1692196,1692203,1692204,1692207,1692217,1692218,1692244,1692258,1692260,1692267,1692270,1692272,1692274,1692275,1692296,1692311,1692330,1692333,1692338,1692370,1692376,1692377,1692436,1692439,1692478,1692482,1692487,1692507,1692512,1692514,1692540,1692551,1692553,1692556,1692565,1692569,1692577,1692600,1692606,1692609,1692610,1692613,1692615,1692625,1692634,1692648,1692649,1692655,1692671,1692681,1692707,1692711,1692721,1692722,1692730,1692734,1692765,1692766,1692783,1692788,1692798,1692801,1692802,1692803,1692816,1692842,1692844,1692855,1692875,1692906,1692916,1692920,1692922,1692926,1692927,1692963,1692966,1692968,1692971,1692974,1692991,1692992,1692994,1692997,1693005,1693008,1693026,1693027,1693057,1693068,1693071,1693079,1693088,1693091,1693092,1693097,1693100,1693119,1693120,1693131,1693140,1693149,1693162,1693163,1693165,1693169,1693179,1693199,1693222,1693237,1693239,1693245,1693260,1693272,1693280,1693287,1693289,1693299,1693309,1693311,1693316,1693342,1693351,1693357,1693362,1693375,1693379,1693385,1693415,1693418,1693419,1693420,1693429,1693435,1693436,1693450,1693459,1693482,1693497,1693507,1693535,1693536,1693539,1693555,1693574,1693579,1693681,1693686,1693706,1693709,1693747,1693748,1693753,1693765,1693766,1693775,1693778,1693792,1693800,1693842,1693843,1693852,1693858,1693859,1693872,1693875,1693890,1693892,1693919,1693921,1693926,1693927,1693933,1693935,1693962,1693965,1693966,1693998,1693999,1694010,1694013,1694018,1694019,1694022,1694028,1694033,1694034,1694048,1694049,1694056,1694060,1694062,1694084,1694094,1694104,1694120,1694128,1694133,1694135,1694139,1694146,1694152,1694162,1694183,1694188,1694197,1694198,1694202,1694212,1694220,1694273,1694331,1694342,1694626,1694697,1694727,1694765,1694837,1694908,1695051,1695123,1695165,1695196,1695433,1695514,1695586,1695659,1695734,1695799,1695951,1696281,1696410,1696484,1696557,1696630,1696701,1696774,1696843,1696873,1696917,1697060,1697136,1697267,1697337,1697404,1697545,1697780,1698115,1698184,1698254,1698386,1698527,1698664,1698738,1698867,1698951,1699071,1699288,1699364,1699566,1699627,1699710,1699856,1699874,1700018,1700086,1700157,1700227,1700297,1700507,1700576,1700640,1700782,1700849,1700860,1700922,1701210,1701354,1701426,1701491,1701767,1701839,1701905,1701936,1701966,1702109,1702233,1702300,1702373,1702438,1702579,1702640,1702963,1703036,1703107,1703174,1703238,1703282,1703312,1703313,1703448,1703572,1703663,1703733,1703860,1703925,1703995,1704068,1704267,1704336,1704406,1704476,1704549,1704618,1704753,1704893,1704966,1705036,1705102,1705165,1705234,1705335,1705427,1705501,1705573,1705643,1705706,1705842,1705987,1706046,1706119,1706246,1706383,1706540,1706681,1706757,1706834,1707040,1707122,1707324,1707396,1707465,1707538,1707644,1707864,1707916,1707987,1708214,1708248,1708315,1708447,1708645,1708795,1709048,1709114,1709191,1709259,1709400,1709470,1709610,1709683,1709742,1709808,1709875,1710003,1710068,1710400,1710534,1710604,1710675,1710741,1710806,1711022,1711156,1711230,1711299,1711367,1711368,1711503,1711572,1711703,1711771,1711837,1711902,1711970,1712037,1712370,1712636,1712773,1712843,1712990,1713064,1713338,1713410,1713418,1713427,1713479,1713488,1713511,1713537,1713543,1713547,1713615,1713619,1713623,1713654,1713675,1713721,1713749,1713750,1713818,1713820,1713841,1713872,1713886,1713893,1713901,1713913,1713949,1714011,1714074,1714103,1714115,1714125,1714136,1714198,1714212,1714234,1714269,1714333,1714390,1714400,1714401,1714405,1714517,1714546,1714611,1714650,1714749,1714762,1714774,1714786,1714807,1714819,1714822,1714878,1714884,1714889,1714910,1715001,1715017,1715059,1715070,1715074,1715108,1715119,1715166,1715194,1715233,1715249,1715263,1715334,1715419,1715502,1715534,1715563,1715636,1715659,1715695,1715699,1715775,1715825,1715875,1715948,1715955,1715995,1716073,1716138,1716191,1716199,1716204,1716216,1716271,1716344,1716350,1716381,1716409,1716412,1716417,1716426,1716497,1716585,1716615,1716640,1716656,1716660,1716661,1716671,1716682,1716687,1716695,1716708,1716716,1716732,1716747,1716765,1716784,1716786,1716947,1717074,1717077,1717143,1717145,1717157,1717216,1717227,1717248,1717296,1717349,1717366,1717391,1717412,1717424,1717431,1717442,1717489,1717512,1717527,1717566,1717575,1717620,1717634,1717641,1717657,1717661,1717739,1717833,1717840,1717853,1717903,1717957,1717958,1717984,1717996,1718023,1718034,1718041,1718045,1718083,1718115,1718147,1718177,1718198,1718203,1718323,1718388,1718525,1718599,1718735,1718802,1718879,1718954,1719030,1719071,1719105,1719475,1719545,1719614,1719691,1719766,1719906,1720049,1720201,1720271,1720345,1720419,1720497,1720570,1720794,1720864,1720937,1721078,1721149,1721278,1721404,1721473,1721544,1721678,1721743,1722129,1722188,1722325,1722456,1722588,1722729,1722810,1723038,1723108,1723177,1723332,1723404,1723549,1723618,1723839,1724073,1724148,1724226,1724295,1724366,1724378,1724477,1724497,1724505,1724508,1724555,1724576,1724585,1724590,1724605,1724740,1724797,1724872,1724879,1724954,1725015,1725031,1725046,1725360,1725394,1725414,1725447,1725461,1725531,1725578,1725647,1725719,1725790,1725937,1726006,1726078,1726154,1726235,1726309,1726459,1726538,1726611,1726759,1726833,1726976,1727049,1727120,1727195,1727271,1727345,1727440,1727484,1727528,1727548,1727557,1727624,1727701,1727955,1728056,1728117,1728129,1728206,1728353,1728432,1728507,1728582,1728802,1728879,1729027,1729325,1729400,1729481,1729560,1729702,1729939,1730078,1730150,1730221,1730253,1730298,1730392,1730454,1730460,1730461,1730463,1730482,1730515,1730546,1730598,1730639,1730678,1730706,1730728,1730763,1730808,1730827,1730900,1730936,1730940,1730977,1731016,1731415,1731420,1731569,1731637,1731776,1731925,1732092,1732174,1732396,1732540,1732692,1732835,1732840,1732841,1732846,1732858,1732859,1732875,1732880,1732888,1732895,1732903,1732980,1732990,1733001,1733079,1733229,1733361,1733430,1733511,1733572,1733631,1733639,1733644,1733647,1733660,1733661,1733663,1733664,1733665,1733666,1733667,1733668,1733669,1733670,1733671,1733672,1733673,1733674,1733675,1733676,1733677,1733678,1733679,1733680,1733681,1733682,1733683,1733684,1733685,1733686,1733687,1733688,1733689,1733690,1733691,1733692,1733693,1733694,1733695,1733696,1733697,1733698,1733699,1733701,1733702,1733795,1733812,1733840,1733964,1734019,1734038,1734103,1734176,1734186,1734249,1734294,1734295,1734296,1734303,1734306,1734307,1734308,1734313,1734314,1734316,1734318,1734319,1734321,1734322,1734325,1734326,1734328,1734330,1734331,1734332,1734333,1734334,1734336,1734338,1734341,1734343,1734344,1734346,1734347,1734348,1734349,1734352,1734355,1734356,1734357,1734360,1734362,1734364,1734365,1734368,1734369,1734373,1734374,1734376,1734377,1734380,1734381,1734382,1734385,1734387,1734388,1734392,1734393,1734394,1734396,1734398,1734400,1734401,1734405,1734406,1734409,1734411,1734413,1734416,1734419,1734420,1734421,1734422,1734425,1734427,1734428,1734433,1734434,1734435,1734436,1734437,1734438,1734442,1734443,1734445,1734446,1734449,1734452,1734453,1734455,1734456,1734457,1734459,1734464,1734465,1734468,1734470,1734472,1734473,1734474,1734476,1734478,1734485,1734487,1734488,1734490,1734492,1734493,1734494,1734495,1734499,1734501,1734503,1734508,1734512,1734516,1734519,1734520,1734522,1734523,1734526,1734528,1734530,1734531,1734533,1734535,1734538,1734540,1734541,1734543,1734544,1734545,1734546,1734549,1734550,1734553,1734554,1734556,1734558,1734561,1734562,1734563,1734564,1734566,1734567,1734568,1734569,1734570,1734571,1734572,1734575,1734579,1734581,1734583,1734584,1734585,1734587,1734588,1734589,1734592,1734593,1734599,1734602,1734603,1734605,1734608,1734609,1734610,1734611,1734612,1734615,1734618,1734620,1734621,1734622,1734623,1734624,1734626,1734627,1734630,1734631,1734632,1734634,1734635,1734636,1734638,1734640,1734641,1734644,1734646,1734647,1734648,1734649,1734650,1734653,1734654,1734655,1734657,1734658,1734659,1734660,1734661,1734662,1734663,1734664,1734666,1734667,1734668,1734669,1734671,1734672,1734673,1734677,1734678,1734680,1734681,1734683,1734684,1734685,1734686,1734688,1734689,1734690,1734692,1734695,1734696,1734697,1734699,1734701,1734702,1734703,1734704,1734705,1734706,1734707,1734708,1734710,1734711,1734712,1734713,1734714,1734715,1734716,1734717,1734718,1734719,1734720,1734722,1734723,1734724,1734725,1734727,1734728,1734729,1734730,1734731,1734732,1734733,1734734,1734735,1734736,1734737,1734738,1734739,1734740,1734741,1734742,1734743,1734744,1734746,1734747,1734748,1734749,1734750,1734751,1734753,1734754,1734755,1734756,1734757,1734758,1734759,1734760,1734762,1734763,1734764,1734765,1734766,1734767,1734768,1734769,1734771,1734772,1734773,1734774,1734775,1734776,1734777,1734778,1734779,1734780,1734781,1734782,1734783,1734784,1734785,1734786,1734787,1734788,1734789,1734790,1734791,1734792,1734793,1734794,1734796,1734797,1734798,1734800,1734801,1734802,1734803,1734804,1734805,1734806,1734807,1734808,1734809,1734810,1734811,1734813,1734814,1734815,1734816,1734817,1734818,1734819,1734820,1734821,1734823,1734824,1734825,1734826,1734827,1734828,1734830,1734831,1734832,1734833,1734834,1734835,1734837,1734838,1734839,1734840,1734841,1734842,1734843,1734844,1734845,1734846,1734848,1734849,1734850,1734851,1734852,1734853,1734854,1734855,1734856,1734857,1734858,1734859,1734860,1734861,1734862,1734863,1734864,1734865,1734866,1734867,1734868,1734869,1734870,1734871,1734872,1734873,1734874,1734875,1734876,1734877,1734878,1734879,1734881,1734882,1734883,1734884,1734885,1734886,1734887,1734889,1734890,1734891,1734892,1734893,1734894,1734897,1734898,1734899,1734900,1734901,1734902,1734903,1734904,1734905,1734906,1734907,1734908,1734909,1734910,1734911,1734912,1734913,1734914,1734915,1734916,1734917,1734918,1734919,1734920,1734921,1734922,1734923,1734925,1734926,1734928,1734929,1734930,1734931,1734932,1734933,1734934,1734935,1734936,1734938,1734939,1734940,1734941,1734942,1734943,1734944,1734945,1734946,1734947,1734948,1734949,1734950,1734951,1734952,1734954,1734955,1734956,1734957,1734958,1734959,1734960,1734961,1734962,1734963,1734964,1734965,1734966,1734967,1734968,1734969,1734970,1734971,1734972,1734973,1734974,1734975,1734976,1734977,1734978,1734979,1734980,1734981,1734983,1734985,1734986,1734987,1734988,1734989,1734990,1734991,1734992,1734994,1734995,1734997,1735004,1735012,1735022,1735037,1735053,1735079,1735092,1735111,1735125,1735126,1735149,1735151,1735155,1735185,1735199,1735231,1735240,1735278,1735282,1735311,1735312,1735314,1735315,1735316,1735317,1735320,1735321,1735322,1735323,1735325,1735327,1735329,1735331,1735333,1735334,1735335,1735336,1735337,1735339,1735341,1735343,1735344,1735345,1735346,1735348,1735349,1735352,1735353,1735354,1735358,1735363,1735364,1735365,1735366,1735368,1735369,1735370,1735373,1735375,1735376,1735377,1735378,1735379,1735381,1735382,1735384,1735385,1735386,1735387,1735389,1735390,1735391,1735396,1735397,1735399,1735400,1735401,1735404,1735408,1735409,1735410,1735413,1735415,1735416,1735418,1735419,1735420,1735422,1735423,1735424,1735426,1735427,1735429,1735431,1735432,1735434,1735435,1735443,1735444,1735445,1735446,1735447);
$arquivo = 'Abril-18.xml';
    
//Iterando item por item do Array $myArray
for ($i = 0; $i < count($myArray); $i++) {
$xmlTotal = '<?xml version="1.0" encoding="iso-8859-1"?>';
$xmlTotal .= '<CancelarNfseEnvio xmlns="https://ws.imap.org.br/siam/nfse.xsd" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">';
$xmlTotal .= '<Pedido>';
$xmlTotal .= '<InfPedidoCancelamento Id="Cancelamento_201301">';
$xmlTotal .= '<IdentificacaoNfse>';
$xmlTotal .= '<Numero>'. $myArray[$i] .'</Numero>';
$xmlTotal .= '<CpfCnpj>';
$xmlTotal .= '<Cnpj>05261547000164</Cnpj>';
$xmlTotal .= '</CpfCnpj>';
$xmlTotal .= '<InscricaoMunicipal>450021</InscricaoMunicipal>';
$xmlTotal .= '<CodigoMunicipio>2310803</CodigoMunicipio>';
$xmlTotal .= '</IdentificacaoNfse>';
$xmlTotal .= '<CodigoCancelamento>1</CodigoCancelamento>';
$xmlTotal .= '<MotivoCancelamento>Erro no preenchimento dos dados</MotivoCancelamento>';
$xmlTotal .= '</InfPedidoCancelamento>';
$xmlTotal .= '</Pedido>';
$xmlTotal .= '</CancelarNfseEnvio>';


Try{

 $soap = new SoapClient('https://ws.imap.org.br/siam/nfse.svc?wsdl', array('trace' => 1));


$parameters['parameters']['param'] = $xmlTotal;
$result = $soap->__soapCall("CancelarNfseEnvio", $parameters);
//if($error = $soap->Error()){ die($error);} 
} catch (SoapFault $fault) {
    trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
    $f = fopen('ERROS.xml','a+');
        fwrite($f, SERIALIZE($fault). PHP_EOL);
        fclose($f);
}
if($result){
    
$f = fopen($arquivo,'a+');
        fwrite($f, SERIALIZE($result). PHP_EOL);
        fclose($f);
        echo ($myArray[$i] . ' Cancelado'.'<br>'); 
       
} 
else {
    print_r ($result); 
}

  usleep(500);
}
?>