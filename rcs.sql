/*
Navicat MySQL Data Transfer

Source Server         : abc
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : rcs

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-04-10 13:08:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `article`
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id_text` int(5) NOT NULL AUTO_INCREMENT,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `topic` varchar(100) NOT NULL,
  `intro` varchar(350) NOT NULL,
  `article` varchar(20000) NOT NULL,
  `id_user` int(5) NOT NULL,
  `id_cat` int(5) NOT NULL,
  `foto` varchar(40) NOT NULL,
  `views` int(10) NOT NULL DEFAULT '0',
  `id_auto1` int(5) DEFAULT NULL,
  `id_auto2` int(5) DEFAULT NULL,
  PRIMARY KEY (`id_text`),
  KEY `art-cat` (`id_cat`),
  KEY `art-usr` (`id_user`),
  KEY `art-aut1` (`id_auto1`),
  KEY `art-aut2` (`id_auto2`),
  CONSTRAINT `art-aut1` FOREIGN KEY (`id_auto1`) REFERENCES `auto_art` (`id_opt`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `art-aut2` FOREIGN KEY (`id_auto2`) REFERENCES `auto_art` (`id_opt`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `art-cat` FOREIGN KEY (`id_cat`) REFERENCES `category` (`id_cat`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `art-usr` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('17', '2018-03-06 15:59:42', 'Prezentacja najnowszego modelu Mclaren\'a 720S', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce a nisl vitae metus dictum vulputate in et dui. Duis sed.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas accumsan orci ut lectus viverra varius. Nunc vel magna a nisi ultricies pulvinar. Donec pulvinar quam sit amet massa commodo, vitae accumsan dui dignissim. Suspendisse eleifend mauris vel tellus pulvinar, vel porttitor velit ultrices. Nunc vulputate quam ante, at varius libero ornare at. Aliquam feugiat sapien ut elit auctor, non luctus quam fringilla. Fusce egestas eros a felis vulputate eleifend. Nullam bibendum semper nisi, quis mollis eros auctor fermentum. Nam vel eleifend arcu, eu sodales ipsum. Etiam vel eros nisl. Pellentesque ut erat non purus mattis mattis vel in lorem. Mauris id tempor mi, eu placerat nisi. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.\r\n\r\nAenean egestas, purus id vehicula mattis, tortor odio pellentesque nisl, sit amet volutpat orci lacus eu est. Quisque non nisl interdum, vehicula orci eu, viverra lorem. Duis vestibulum, quam elementum lacinia tincidunt, urna purus accumsan justo, a finibus elit justo et metus. Proin quis dictum nisi, a facilisis velit. Donec consequat consequat fringilla. Vestibulum vel tempor magna. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam commodo sit amet libero nec placerat.\r\n\r\nAliquam ipsum nisl, euismod eleifend feugiat nec, mattis vulputate ipsum. Nam at accumsan libero, vitae vulputate tortor. Quisque blandit sodales aliquet. Interdum et malesuada fames ac ante ipsum primis in faucibus. Morbi fringilla mi quam, sit amet ullamcorper libero placerat sed. Phasellus non luctus augue. Nulla vitae magna a lectus malesuada ornare. Donec ligula erat, varius a ullamcorper eget, lacinia id nisl. Praesent eu massa nibh. Donec eu hendrerit magna. Suspendisse potenti. Nunc tincidunt ipsum non ipsum placerat, nec accumsan enim iaculis. Integer et purus arcu. Suspendisse blandit dui rutrum, luctus neque eu, ultrices orci. Vivamus id cursus odio.\r\n\r\nOrci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean et nisl luctus, rutrum urna in, ultrices est. Nullam faucibus venenatis nunc eget rutrum. Nullam aliquam velit eu efficitur ultrices. Donec luctus nisi dolor. Praesent finibus sem et purus elementum ultrices. Curabitur consequat purus ut rutrum pellentesque. Suspendisse tempus tortor nec turpis efficitur malesuada. Nam velit erat, sodales eu ullamcorper a, consectetur et arcu. In facilisis risus lobortis eros varius efficitur. Fusce quis varius mauris, a scelerisque tortor.\r\n\r\nUt ultrices sagittis sodales. Proin nulla mauris, auctor at posuere non, facilisis at lacus. Cras pretium feugiat viverra. Sed rutrum et ex ut hendrerit. Praesent id sodales diam, vitae suscipit magna. Aenean hendrerit ornare velit sit amet pharetra. Donec commodo eros quis ante auctor, quis pellentesque dolor lobortis. Aliquam bibendum lacus scelerisque, pharetra orci sed, egestas dui. Aliquam erat volutpat. Vivamus sit amet placerat magna.\r\n\r\nPraesent eu feugiat leo. Mauris quis justo non tellus lobortis vehicula. Maecenas scelerisque mauris id consequat luctus. Cras id dictum enim. Integer id sodales erat. Etiam interdum dolor a lectus lobortis, vitae tempor lectus semper. Sed quis ultricies purus, non cursus ligula. Proin bibendum ligula nec vulputate vulputate. Donec ullamcorper tortor nec maximus sagittis. Praesent fringilla auctor mi, eget convallis nisi accumsan sed. Nunc nisl diam, consectetur et mauris vitae, congue faucibus nibh.\r\n\r\nAenean ac vehicula mauris. Etiam turpis arcu, finibus volutpat aliquam malesuada, condimentum consectetur tellus. Integer feugiat gravida consectetur. Aliquam tincidunt varius sapien. Donec diam est, cursus eget nunc in, lobortis ullamcorper velit. Cras ac commodo sem. Curabitur hendrerit leo et dolor blandit, in finibus neque sodales. Donec molestie, tellus a imperdiet suscipit, purus lorem iaculis dolor, nec ultricies felis erat eu elit. Aliquam maximus velit erat, vel laoreet tortor sollicitudin nec. Maecenas ultrices, ligula ac scelerisque iaculis, turpis ex pellentesque mi, non efficitur augue enim ut sapien. Sed tempus turpis sagittis dui vestibulum, in tristique dolor fermentum.\r\n\r\nMaecenas turpis odio, rhoncus quis urna a, fermentum faucibus ex. Vivamus tristique, nisl eget tempus luctus, sem nisi hendrerit metus, ut rhoncus massa libero at lacus. Phasellus egestas dignissim ultrices. Praesent egestas varius tellus. Suspendisse eget blandit dolor, vel rhoncus nulla. Mauris porttitor mollis nunc, sit amet efficitur odio tempor a. Aenean pretium dolor odio, eget scelerisque eros ultricies eget. Donec dictum nibh euismod nulla feugiat, a malesuada tortor consequat. Duis vitae tincidunt elit, in dignissim augue. Proin non dolor lacus.', '14', '1', '152034838314.jpg', '6', null, null);
INSERT INTO `article` VALUES ('18', '2018-03-06 16:05:41', 'Historia Shelby Eleanor', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lacinia est nec odio porta venenatis. Integer id fermentum lectus, ac feugiat felis. Mauris posuere eget urna vitae commodo. Sed ac.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eros lorem, molestie at posuere et, pretium nec dui. Sed lobortis volutpat neque. Aliquam mollis enim vitae nisl volutpat, a ultricies mauris dapibus. Integer ac auctor neque, sed ullamcorper metus. Sed efficitur turpis sit amet vehicula sagittis. Duis iaculis leo diam, at elementum sem vulputate at. Fusce luctus tortor metus. Aliquam maximus dapibus ligula, facilisis sodales felis dignissim a. Vivamus nunc erat, placerat et purus vel, ultrices cursus mauris. Nunc in arcu sed nulla ultrices tincidunt non quis tellus. Nulla molestie sapien nec mauris bibendum, at viverra erat pulvinar. Maecenas ac ante volutpat, ultricies orci id, finibus odio. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquet condimentum velit non mollis. Vivamus faucibus lectus et elit aliquam, non bibendum arcu tincidunt.\r\n\r\nIn auctor molestie aliquet. Aliquam tempor est at nunc tincidunt, eu tincidunt dui tempor. Aliquam non tortor nibh. Maecenas sodales felis vel justo volutpat semper. In hac habitasse platea dictumst. Nulla facilisi. Nullam pretium dui eu ante congue bibendum. Etiam dignissim ac enim nec hendrerit. Etiam nisi dui, faucibus et maximus quis, congue vel erat. Nunc tincidunt ornare ligula, vitae facilisis metus faucibus et. Aliquam gravida, arcu quis faucibus commodo, odio dui tempor tellus, in fermentum tellus tellus in quam. Sed porta ante sed risus vehicula, eu eleifend nunc malesuada.\r\n\r\nNullam quis vestibulum metus. Suspendisse potenti. Mauris at vestibulum dui. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed commodo id tortor ac posuere. Nunc ut libero eu orci commodo tempor dignissim vel orci. Phasellus tincidunt tincidunt ante, eget pharetra ex tincidunt non. Nullam et malesuada quam, vel scelerisque mi. Aenean auctor nibh eget tellus malesuada hendrerit. Integer vel nulla at velit pellentesque euismod ut at turpis. Curabitur non ex a leo facilisis auctor sit amet id justo. Fusce non mi porttitor, sollicitudin turpis eget, egestas justo. Aenean viverra turpis et urna rutrum semper. Maecenas mattis augue enim, et tincidunt purus sodales et.\r\n\r\nNunc et facilisis eros. Integer elit turpis, iaculis vitae nulla id, vestibulum finibus nunc. Duis enim tortor, commodo eu magna id, vestibulum ultricies mauris. Curabitur at aliquet dolor, sed tempor enim. Suspendisse nec tincidunt ligula. Nunc enim risus, sodales id gravida accumsan, tincidunt at arcu. Praesent massa diam, semper eget sodales nec, convallis sed lacus. Mauris tincidunt mollis arcu, vitae pellentesque ex ornare ac. Nulla tincidunt eros et justo accumsan iaculis. Pellentesque convallis tincidunt massa vitae vulputate.\r\n\r\nCurabitur ut est mauris. Nulla commodo posuere interdum. Quisque id tincidunt justo. Donec aliquam malesuada eros at elementum. Donec dictum ante sed odio aliquet, id condimentum enim facilisis. Integer congue convallis aliquam. Proin bibendum nunc et orci mollis tempor. Curabitur non elit nisl.\r\n\r\nInteger vitae interdum massa, nec porta diam. Morbi enim erat, vestibulum at est at, rutrum porta turpis. Integer dignissim elit risus, vel condimentum dui eleifend sed. Integer efficitur finibus aliquam. Etiam in mauris et tellus imperdiet sodales. Aenean vitae nulla ac lacus vestibulum pharetra vitae nec lacus. Nulla tincidunt luctus vulputate.\r\n\r\nSuspendisse ac nisl vitae dolor porta auctor. Maecenas eros lacus, elementum vitae mauris ac, commodo viverra ante. Vivamus rhoncus sapien eget libero aliquet dictum. Suspendisse fringilla mauris sit amet sapien elementum, in finibus urna accumsan. Proin mattis tempor diam quis sollicitudin. Curabitur faucibus justo enim, ut aliquet arcu pulvinar maximus. Maecenas non ullamcorper ligula. Sed tristique nisl eget neque condimentum feugiat. Morbi dignissim sit amet lectus dignissim consectetur. Praesent ac dignissim velit. Sed lacus risus, mollis id auctor a, congue eu velit.\r\n\r\nNam vestibulum ac lectus ac posuere. Vivamus lacus nibh, ultricies in odio sit amet, dictum hendrerit quam. Phasellus ac sagittis risus. Ut a lorem varius, scelerisque libero at, dapibus magna. Etiam cursus nibh vitae posuere auctor. Cras venenatis ante ac nisi blandit, sed semper diam hendrerit. Sed scelerisque, neque vel aliquam porta, est sem pharetra odio, at efficitur odio mauris eu dui. Cras quis bibendum lacus. Donec fringilla vestibulum elit at posuere. Quisque dignissim, lectus sed ullamcorper scelerisque, ligula justo facilisis metus, ac eleifend purus eros eget eros.\r\n\r\nAliquam facilisis pellentesque convallis. Fusce luctus varius placerat. Sed vel metus sed libero imperdiet malesuada. Sed dictum nulla id magna ullamcorper sagittis. Pellentesque ultrices tempor risus, at fringilla turpis sagittis at. Nunc vel quam est. Cras eget dolor ultricies, venenatis nulla et, sollicitudin lorem. Curabitur accumsan scelerisque interdum. Nam eget egestas ligula. Proin tincidunt tellus semper neque tincidunt, pulvinar molestie lectus consequat.\r\n\r\nMauris congue diam facilisis feugiat consectetur. Morbi tempor eros fermentum tristique sodales. Maecenas ut quam sem. Maecenas aliquam arcu at posuere fermentum. Interdum et malesuada fames ac ante ipsum primis in faucibus. In finibus, magna non sollicitudin consectetur, urna enim efficitur sapien, ac feugiat massa metus nec arcu. In eget erat odio. Quisque porta, odio in aliquet pellentesque, nisi lectus feugiat diam, in dictum arcu elit in lacus. Phasellus posuere dictum iaculis.', '14', '5', '152034874214.jpg', '4', null, null);
INSERT INTO `article` VALUES ('19', '2018-03-06 16:14:42', 'Audi A4 vs BMW Serii 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc luctus ligula ut lectus maximus bibendum. Etiam aliquet elit vitae dolor dapibus interdum. Fusce commodo in leo a faucibus. Aenean finibus.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed fringilla ultrices tellus a consequat. Vivamus vestibulum commodo arcu, in imperdiet elit ornare nec. Aliquam elementum orci eu nulla sagittis, vitae dapibus lectus sagittis. Phasellus justo velit, ullamcorper eu sagittis vehicula, luctus in felis. Sed egestas mollis vestibulum. Quisque laoreet tellus diam, at sollicitudin enim ullamcorper in. Cras vel turpis nisi. Sed porttitor sed eros malesuada ornare. Morbi vel metus a enim pretium porttitor. Nunc auctor dapibus cursus. Donec finibus luctus risus, et accumsan libero dictum a. Quisque aliquet vel tortor a fringilla. Praesent sagittis massa ut metus vestibulum, non finibus lacus molestie. Fusce cursus mauris eget egestas mollis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.\r\n\r\nIn blandit lectus porttitor laoreet accumsan. Integer id lectus finibus, elementum lacus et, iaculis ligula. Mauris fringilla viverra massa, vehicula tincidunt enim luctus et. Vivamus sollicitudin ante nisl, vitae laoreet nunc facilisis gravida. Maecenas dictum lorem urna, vel porta sapien viverra quis. Fusce lacus nisl, tempus et pulvinar sed, blandit eget ipsum. Ut nec mattis metus. Fusce et volutpat tellus. Nullam condimentum ut purus non bibendum. Fusce quis elit eu nisi aliquet tincidunt sed vitae est. Sed tincidunt bibendum neque, quis lobortis nisi lacinia tincidunt.\r\n\r\nCras a eleifend lectus, ut fermentum risus. Cras vitae lectus et diam elementum varius vitae ac erat. Nunc non magna elit. Duis hendrerit mi purus, in maximus elit rhoncus eget. Vestibulum ac nisi sit amet metus fermentum tempus. Pellentesque feugiat dolor ac commodo ornare. Cras quam nisl, aliquet a scelerisque nec, consequat eu nisl. In aliquet, sapien in suscipit fermentum, libero ante lacinia enim, sed egestas orci mauris vel nulla. Etiam porta faucibus lobortis. Praesent volutpat pretium quam, ac vehicula massa consequat aliquam. Suspendisse lacinia felis libero, sit amet pulvinar erat tempor eget. Mauris a molestie ante, vitae efficitur purus. Sed non ullamcorper mauris. Praesent pellentesque tortor faucibus tempus molestie. Phasellus pretium, neque eget viverra vestibulum, augue purus tempor diam, nec condimentum neque ante eu risus. Aliquam vehicula velit sit amet luctus finibus.\r\n\r\nSuspendisse lorem diam, molestie iaculis vulputate sed, ultrices sed tortor. Donec fringilla, justo in porta porta, magna nunc ornare massa, vel pretium enim est egestas tortor. Pellentesque at justo nulla. Donec dignissim leo est, a luctus mauris tempor consequat. Phasellus lacinia dignissim ante, non molestie justo suscipit non. Duis semper consectetur auctor. Curabitur vel congue nisi. Maecenas ut vehicula nisi. Cras vel lorem sem. Donec est odio, pretium in ex ut, blandit semper nisl. Donec fringilla quam sit amet nisl pretium, at fringilla ante consectetur. Praesent dignissim lacus urna, ac blandit dui interdum sit amet. Suspendisse pulvinar dui tellus, a tempor dui rutrum sit amet.\r\n\r\nNunc eu enim ipsum. Duis laoreet tincidunt risus, in pulvinar felis tristique id. Pellentesque vehicula eros mi, sit amet cursus velit auctor ac. In consectetur nisi vel metus feugiat, in mattis sem placerat. Aliquam sit amet sagittis massa, in elementum dolor. Nam sagittis, eros id dignissim venenatis, turpis turpis pretium felis, vitae blandit arcu erat sit amet odio. Integer justo libero, sagittis sed neque at, fermentum pharetra sem. Vestibulum rutrum venenatis urna in cursus. Etiam lobortis suscipit dolor sed sagittis. Morbi dictum ut turpis ut tempor. Cras blandit, felis eu finibus finibus, nulla diam scelerisque tortor, ut tincidunt sem augue ac nisl. Integer finibus sapien vitae interdum suscipit.\r\n\r\nNunc lacinia lobortis augue in tincidunt. Nullam semper leo nec risus egestas, eget ultrices libero gravida. Sed ut ante vel nibh feugiat varius. Mauris feugiat et nibh ut suscipit. Sed sollicitudin enim eu dui aliquet congue vel at lectus. Aliquam nec erat et urna euismod tincidunt eu non ex. Maecenas laoreet sodales nulla. Nunc et odio tempor, euismod nisl ac, convallis neque. Nullam ut efficitur leo. Curabitur eu interdum ex. Proin ultrices, leo eu tempus aliquam, nisi leo ullamcorper orci, id blandit lectus mi ac purus. Duis vulputate urna eros, vel luctus diam molestie ac. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.\r\n\r\nVivamus dui nisl, pulvinar vel diam a, blandit varius metus. Fusce purus neque, efficitur in felis et, suscipit commodo diam. Nunc enim ipsum, luctus ac neque facilisis, suscipit ultricies tortor. Integer et gravida neque. Sed pulvinar elit eu varius tincidunt. Aliquam ut ultricies erat. Pellentesque imperdiet erat non fringilla tristique. Maecenas tristique imperdiet elit in mattis. Nullam vitae lobortis diam. Quisque faucibus massa sem, et viverra nunc ullamcorper et. Vestibulum consequat, arcu eget iaculis porta, velit lorem porta dui, sed varius tortor lorem non tortor. Maecenas vulputate, dui at ornare malesuada, sem risus pretium nibh, non eleifend arcu purus nec massa. Sed eu pulvinar purus.\r\n\r\nMaecenas ornare neque magna, sit amet vulputate dolor eleifend eget. Vestibulum bibendum rutrum tortor at varius. Pellentesque viverra eu nibh fermentum venenatis. Nullam non lacinia felis. Morbi ut viverra ligula, vitae dictum enim. Pellentesque nec nisi neque. Duis in leo vitae nibh laoreet feugiat vel ut ipsum.\r\n\r\nCras eget pellentesque erat, in vulputate turpis. Vestibulum imperdiet lacus lacus, non pharetra est fringilla sed. Mauris in varius quam. Vivamus nibh elit, scelerisque id eleifend at, faucibus id ex. Donec ut tellus ac ligula suscipit sodales. Donec sollicitudin a metus eu pellentesque. Sed bibendum elit ac arcu congue mollis. Nam ullamcorper massa quis ipsum bibendum, at feugiat nulla auctor. Nunc lobortis, enim non euismod pretium, nibh ex faucibus sapien, ac venenatis elit tellus nec ante.\r\n\r\nDonec in urna quis enim faucibus fringilla. Suspendisse ut sapien in augue placerat feugiat. Cras congue euismod convallis. In non nunc vitae augue euismod suscipit et vel ante. Phasellus tincidunt sodales pretium. Etiam diam tellus, lacinia et velit at, suscipit tristique sem. Cras vel risus diam. In sodales dignissim porttitor. Quisque a augue facilisis, ultricies ante vel, eleifend tortor.', '14', '3', '152034928114.JPG', '7', '5', '6');
INSERT INTO `article` VALUES ('20', '2018-03-06 16:17:19', 'Testowa porada dla Audi A4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla efficitur iaculis nisi, consequat gravida est elementum id. Maecenas vestibulum nisl tincidunt, bibendum lectus sit amet, venenatis justo. Curabitur est risus, condimentum vitae pharetra nec, venenatis.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla consectetur tempus tincidunt. Nunc laoreet nulla fringilla sodales tempor. Praesent laoreet magna at tortor euismod, eu rutrum dui mattis. Suspendisse sit amet sem pulvinar, pellentesque ipsum in, lobortis diam. Aliquam ut augue nec turpis lacinia semper. Aenean imperdiet luctus iaculis. Sed massa augue, laoreet ut pellentesque non, accumsan non erat. Sed mauris arcu, luctus vestibulum euismod quis, sodales ullamcorper ex. Aenean elit quam, pharetra sed orci sit amet, posuere hendrerit velit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque ut varius ipsum, nec laoreet libero.\r\n\r\nPellentesque eu varius lectus. Nullam imperdiet felis vitae tincidunt sodales. Nunc vitae auctor lacus. Ut porttitor laoreet enim ornare egestas. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse interdum, elit sed aliquet vulputate, nisi augue varius sem, non volutpat justo elit a sem. Nullam lorem ex, porttitor in fermentum id, porttitor nec orci. Vivamus ultricies felis est, consequat sodales massa convallis ac. Nulla condimentum mi erat. Vestibulum tincidunt libero eu elit mollis porta. Proin mollis ex erat, et congue neque cursus at. Sed blandit vel lorem a vehicula. In ac imperdiet lacus, sed maximus urna. Proin sed gravida lorem. Nam a purus vel metus mattis consequat. Vestibulum metus dui, fringilla nec arcu in, consequat consectetur erat.\r\n\r\nAenean gravida urna vitae arcu imperdiet hendrerit eget sed nibh. Ut accumsan, libero nec lobortis congue, libero magna viverra ex, quis convallis arcu enim in nisi. Integer quis lacinia libero, in tincidunt ante. Aenean id ligula vestibulum, dapibus nibh id, ultrices justo. Donec imperdiet, urna non dignissim tempor, nunc dui condimentum urna, ac gravida elit eros eget ex. Donec ut diam ultricies, tincidunt libero vitae, pellentesque felis. Nulla felis eros, feugiat id mauris non, gravida ultricies erat. Fusce vel dui odio.\r\n\r\nDuis metus purus, sollicitudin nec est ac, feugiat bibendum magna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nullam mattis, nibh vitae tincidunt ultrices, ex nisl congue turpis, sollicitudin interdum mauris metus et ligula. Nunc ultrices libero ex, aliquam euismod lorem lobortis eu. Curabitur in purus suscipit, suscipit metus at, congue odio. Suspendisse est orci, luctus non nulla sit amet, tincidunt tempor sapien. Proin mi tellus, aliquet sed metus a, semper mollis urna. Praesent interdum sit amet enim quis pulvinar. Nam dapibus ultricies felis et congue. Donec a orci consectetur, luctus risus sodales, malesuada mi. Donec ut pretium magna, molestie tincidunt nunc. Proin mi tellus, scelerisque imperdiet blandit in, cursus in enim. Aenean dapibus maximus odio, vel luctus nisl sodales at. Duis tempus, erat nec bibendum facilisis, nisi velit dapibus odio, vel ornare purus justo eu est.\r\n\r\nVivamus purus ligula, accumsan vel luctus quis, convallis quis dui. Morbi pharetra urna erat, ut dictum justo imperdiet vel. Morbi tempor eleifend tellus. Sed venenatis cursus metus, semper sollicitudin tortor tristique vel. Ut at semper ligula, ut dapibus libero. Vivamus quis magna vel quam pharetra bibendum sit amet sit amet mi. Proin a eros posuere, iaculis mi nec, sagittis lacus.\r\n\r\nPellentesque sollicitudin sapien eleifend nibh lobortis, ac tincidunt diam auctor. Nunc sapien erat, fringilla eu molestie vitae, aliquet sed orci. Fusce faucibus enim vel quam placerat bibendum. Duis at turpis augue. Sed elementum, dolor ac finibus hendrerit, enim tellus lacinia dui, sed fringilla nulla nibh non nibh. Vivamus dictum suscipit nisl, eget euismod tellus aliquet nec. Nulla dictum tempus leo. Phasellus pharetra id odio a accumsan. Maecenas sed vestibulum augue, sed laoreet nibh. Morbi et nibh vel turpis bibendum maximus. Sed blandit nulla quis massa scelerisque, faucibus porta eros porttitor.\r\n\r\nNulla facilisi. Curabitur eget tempor ligula. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer malesuada fringilla mattis. Nulla facilisi. Donec consectetur sem eros, aliquam finibus dui varius sed. Aenean ac massa nunc. Suspendisse quis bibendum sapien, nec finibus arcu. Donec posuere quis nisi eget tristique. Nulla sagittis ullamcorper metus, id rutrum tortor malesuada ut. Duis sagittis interdum enim, non dictum lectus congue vel. Aliquam libero metus, sodales vel felis eu, commodo venenatis dui. Phasellus elementum eget justo pulvinar tempor. Etiam non dignissim ante, ac pulvinar diam.', '14', '4', '152034944014.jpg', '19', '7', null);

-- ----------------------------
-- Table structure for `auto_art`
-- ----------------------------
DROP TABLE IF EXISTS `auto_art`;
CREATE TABLE `auto_art` (
  `id_opt` int(5) NOT NULL AUTO_INCREMENT,
  `id_m` int(5) NOT NULL,
  `id_mm` int(5) NOT NULL,
  `rok` int(4) NOT NULL,
  `rokdo` int(4) DEFAULT NULL,
  `silnik` varchar(20) COLLATE utf8_polish_ci DEFAULT NULL,
  `poj` int(4) DEFAULT NULL,
  `moc` int(4) DEFAULT NULL,
  `acc` int(4) DEFAULT NULL,
  `vmax` int(3) DEFAULT NULL,
  `spalanie` int(4) DEFAULT NULL,
  `gears` varchar(20) COLLATE utf8_polish_ci DEFAULT NULL,
  `naped` varchar(20) COLLATE utf8_polish_ci DEFAULT NULL,
  `cena` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_opt`),
  KEY `aart-m` (`id_m`),
  KEY `aart-mm` (`id_mm`),
  CONSTRAINT `aart-m` FOREIGN KEY (`id_m`) REFERENCES `car_make` (`id_m`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `aart-mm` FOREIGN KEY (`id_mm`) REFERENCES `car_model` (`id_mm`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- ----------------------------
-- Records of auto_art
-- ----------------------------
INSERT INTO `auto_art` VALUES ('5', '1', '1', '2018', null, '3.2 FSI', '3200', '320', '6', '250', '8', '6-biegowa, manualna', '4x4', '260000');
INSERT INTO `auto_art` VALUES ('6', '2', '25', '2018', null, '336d xDrive', '2993', '313', '5', '250', '6', 'Automatyczna', 'Tył', '2150000');
INSERT INTO `auto_art` VALUES ('7', '1', '1', '1995', '2018', null, null, null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for `car`
-- ----------------------------
DROP TABLE IF EXISTS `car`;
CREATE TABLE `car` (
  `id_car` int(5) NOT NULL AUTO_INCREMENT,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int(5) DEFAULT NULL,
  `id_option` int(5) DEFAULT NULL,
  `id_m` int(5) NOT NULL,
  `id_mm` int(5) DEFAULT NULL,
  PRIMARY KEY (`id_car`),
  KEY `car-opt` (`id_option`),
  KEY `car-usr` (`id_user`),
  KEY `car-m` (`id_m`),
  KEY `car-mm` (`id_mm`),
  CONSTRAINT `car-m` FOREIGN KEY (`id_m`) REFERENCES `car_make` (`id_m`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `car-mm` FOREIGN KEY (`id_mm`) REFERENCES `car_model` (`id_mm`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `car-opt` FOREIGN KEY (`id_option`) REFERENCES `options` (`id_option`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `car-usr` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of car
-- ----------------------------
INSERT INTO `car` VALUES ('58', '2018-03-06 14:40:53', '11', '21', '1', '1');
INSERT INTO `car` VALUES ('59', '2018-03-06 14:45:04', '11', '22', '47', '366');
INSERT INTO `car` VALUES ('60', '2018-03-06 14:51:18', '12', '23', '50', '381');
INSERT INTO `car` VALUES ('62', '2018-03-06 15:22:16', '12', '25', '1', '1');
INSERT INTO `car` VALUES ('63', '2018-03-06 15:27:14', '13', '26', '2', '25');
INSERT INTO `car` VALUES ('64', '2018-03-06 15:54:55', '11', '27', '1', '1');

-- ----------------------------
-- Table structure for `car_make`
-- ----------------------------
DROP TABLE IF EXISTS `car_make`;
CREATE TABLE `car_make` (
  `id_m` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id_m`),
  FULLTEXT KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of car_make
-- ----------------------------
INSERT INTO `car_make` VALUES ('1', 'Audi');
INSERT INTO `car_make` VALUES ('2', 'BMW');
INSERT INTO `car_make` VALUES ('3', 'Volkswagen');
INSERT INTO `car_make` VALUES ('4', 'Nissan');
INSERT INTO `car_make` VALUES ('5', 'Ferrari');
INSERT INTO `car_make` VALUES ('6', 'McLaren');
INSERT INTO `car_make` VALUES ('7', 'Mitsubishi');
INSERT INTO `car_make` VALUES ('8', 'Alfa Romeo');
INSERT INTO `car_make` VALUES ('9', 'Aston Martin');
INSERT INTO `car_make` VALUES ('10', 'Bentley');
INSERT INTO `car_make` VALUES ('12', 'Chevrolet');
INSERT INTO `car_make` VALUES ('13', 'Chrysler');
INSERT INTO `car_make` VALUES ('14', 'Citroen');
INSERT INTO `car_make` VALUES ('15', 'Dacia');
INSERT INTO `car_make` VALUES ('16', 'Daewoo');
INSERT INTO `car_make` VALUES ('17', 'Dodge');
INSERT INTO `car_make` VALUES ('18', 'Fiat');
INSERT INTO `car_make` VALUES ('19', 'Ford');
INSERT INTO `car_make` VALUES ('20', 'Honda');
INSERT INTO `car_make` VALUES ('21', 'Hummer');
INSERT INTO `car_make` VALUES ('22', 'Hyundai');
INSERT INTO `car_make` VALUES ('23', 'Infiniti');
INSERT INTO `car_make` VALUES ('24', 'Jaguar');
INSERT INTO `car_make` VALUES ('25', 'Jeep');
INSERT INTO `car_make` VALUES ('26', 'Kia');
INSERT INTO `car_make` VALUES ('27', 'Lamborgini');
INSERT INTO `car_make` VALUES ('28', 'Lancia');
INSERT INTO `car_make` VALUES ('29', 'Land Rover');
INSERT INTO `car_make` VALUES ('30', 'Lexus');
INSERT INTO `car_make` VALUES ('31', 'Maserati');
INSERT INTO `car_make` VALUES ('32', 'Mazda');
INSERT INTO `car_make` VALUES ('33', 'Mercedes-Benz');
INSERT INTO `car_make` VALUES ('34', 'Mini');
INSERT INTO `car_make` VALUES ('35', 'Opel');
INSERT INTO `car_make` VALUES ('36', 'Peugeot');
INSERT INTO `car_make` VALUES ('37', 'Polonez');
INSERT INTO `car_make` VALUES ('38', 'Pontiac');
INSERT INTO `car_make` VALUES ('39', 'Porsche');
INSERT INTO `car_make` VALUES ('40', 'Renault');
INSERT INTO `car_make` VALUES ('41', 'Rolls-Royce');
INSERT INTO `car_make` VALUES ('42', 'Rover');
INSERT INTO `car_make` VALUES ('43', 'Saab');
INSERT INTO `car_make` VALUES ('44', 'Seat');
INSERT INTO `car_make` VALUES ('45', 'Skoda');
INSERT INTO `car_make` VALUES ('46', 'Smart');
INSERT INTO `car_make` VALUES ('47', 'Subaru');
INSERT INTO `car_make` VALUES ('48', 'Suzuki');
INSERT INTO `car_make` VALUES ('49', 'Tesla');
INSERT INTO `car_make` VALUES ('50', 'Toyota');
INSERT INTO `car_make` VALUES ('51', 'Volvo');

-- ----------------------------
-- Table structure for `car_model`
-- ----------------------------
DROP TABLE IF EXISTS `car_model`;
CREATE TABLE `car_model` (
  `id_mm` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `id_m` int(5) NOT NULL,
  PRIMARY KEY (`id_mm`),
  KEY `mm-m` (`id_m`),
  CONSTRAINT `mm-m` FOREIGN KEY (`id_m`) REFERENCES `car_make` (`id_m`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=405 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of car_model
-- ----------------------------
INSERT INTO `car_model` VALUES ('1', 'A4', '1');
INSERT INTO `car_model` VALUES ('2', 'M3', '2');
INSERT INTO `car_model` VALUES ('3', 'Q5', '1');
INSERT INTO `car_model` VALUES ('5', 'GT-R', '4');
INSERT INTO `car_model` VALUES ('6', '720S', '6');
INSERT INTO `car_model` VALUES ('7', 'Evo', '7');
INSERT INTO `car_model` VALUES ('11', 'A1', '1');
INSERT INTO `car_model` VALUES ('12', 'A2', '1');
INSERT INTO `car_model` VALUES ('13', 'A3', '1');
INSERT INTO `car_model` VALUES ('14', 'A5', '1');
INSERT INTO `car_model` VALUES ('15', 'A6', '1');
INSERT INTO `car_model` VALUES ('16', 'A7', '1');
INSERT INTO `car_model` VALUES ('17', 'A8', '1');
INSERT INTO `car_model` VALUES ('18', 'Q2', '1');
INSERT INTO `car_model` VALUES ('19', 'Q3', '1');
INSERT INTO `car_model` VALUES ('20', 'Q7', '1');
INSERT INTO `car_model` VALUES ('21', 'R8', '1');
INSERT INTO `car_model` VALUES ('22', 'TT', '1');
INSERT INTO `car_model` VALUES ('23', 'Seria 1', '2');
INSERT INTO `car_model` VALUES ('24', 'Seria 2', '2');
INSERT INTO `car_model` VALUES ('25', 'Seria 3', '2');
INSERT INTO `car_model` VALUES ('26', 'Seria 4', '2');
INSERT INTO `car_model` VALUES ('27', 'Seria 5', '2');
INSERT INTO `car_model` VALUES ('28', 'Seria 6', '2');
INSERT INTO `car_model` VALUES ('29', 'Seria 7', '2');
INSERT INTO `car_model` VALUES ('30', 'Seria 8', '2');
INSERT INTO `car_model` VALUES ('31', 'M2', '2');
INSERT INTO `car_model` VALUES ('32', 'M3', '2');
INSERT INTO `car_model` VALUES ('33', 'M4', '2');
INSERT INTO `car_model` VALUES ('34', 'M5', '2');
INSERT INTO `car_model` VALUES ('35', 'M6', '2');
INSERT INTO `car_model` VALUES ('36', 'X1', '2');
INSERT INTO `car_model` VALUES ('37', 'X2', '2');
INSERT INTO `car_model` VALUES ('38', 'X3', '2');
INSERT INTO `car_model` VALUES ('39', 'X4', '2');
INSERT INTO `car_model` VALUES ('40', 'X5', '2');
INSERT INTO `car_model` VALUES ('41', 'X6', '2');
INSERT INTO `car_model` VALUES ('42', 'Z3', '2');
INSERT INTO `car_model` VALUES ('43', 'Z4', '2');
INSERT INTO `car_model` VALUES ('44', 'i3', '2');
INSERT INTO `car_model` VALUES ('45', 'i8', '2');
INSERT INTO `car_model` VALUES ('46', 'Amarok', '3');
INSERT INTO `car_model` VALUES ('47', 'Arteon', '3');
INSERT INTO `car_model` VALUES ('48', 'Beetle', '3');
INSERT INTO `car_model` VALUES ('49', 'Caddy', '3');
INSERT INTO `car_model` VALUES ('50', 'Golf', '3');
INSERT INTO `car_model` VALUES ('51', 'Jetta', '3');
INSERT INTO `car_model` VALUES ('62', 'Lupo', '3');
INSERT INTO `car_model` VALUES ('63', 'Passat', '3');
INSERT INTO `car_model` VALUES ('64', 'Polo', '3');
INSERT INTO `car_model` VALUES ('65', 'Scirocco', '3');
INSERT INTO `car_model` VALUES ('66', 'Tiguan', '3');
INSERT INTO `car_model` VALUES ('67', 'Touareg', '3');
INSERT INTO `car_model` VALUES ('68', 'Touran', '3');
INSERT INTO `car_model` VALUES ('69', 'up!', '3');
INSERT INTO `car_model` VALUES ('70', '350 Z', '4');
INSERT INTO `car_model` VALUES ('71', '370 Z', '4');
INSERT INTO `car_model` VALUES ('72', 'Almera', '4');
INSERT INTO `car_model` VALUES ('73', 'Frontier', '4');
INSERT INTO `car_model` VALUES ('74', 'Juke', '4');
INSERT INTO `car_model` VALUES ('75', 'Micra', '4');
INSERT INTO `car_model` VALUES ('76', 'Navara', '4');
INSERT INTO `car_model` VALUES ('77', 'Note', '4');
INSERT INTO `car_model` VALUES ('78', 'Pathfinder', '4');
INSERT INTO `car_model` VALUES ('79', 'Patrol', '4');
INSERT INTO `car_model` VALUES ('80', 'Primera', '4');
INSERT INTO `car_model` VALUES ('81', 'Qashqai', '4');
INSERT INTO `car_model` VALUES ('82', 'Sentra', '4');
INSERT INTO `car_model` VALUES ('83', 'X-Trail', '4');
INSERT INTO `car_model` VALUES ('84', '458 Ilalia', '5');
INSERT INTO `car_model` VALUES ('85', '599', '5');
INSERT INTO `car_model` VALUES ('86', '812 Superfast', '5');
INSERT INTO `car_model` VALUES ('87', 'California', '5');
INSERT INTO `car_model` VALUES ('88', 'F12', '5');
INSERT INTO `car_model` VALUES ('89', 'F430', '5');
INSERT INTO `car_model` VALUES ('90', 'LaFerrari', '5');
INSERT INTO `car_model` VALUES ('91', '675', '6');
INSERT INTO `car_model` VALUES ('92', 'MP4-12C', '6');
INSERT INTO `car_model` VALUES ('93', '570S', '6');
INSERT INTO `car_model` VALUES ('94', 'ASX', '7');
INSERT INTO `car_model` VALUES ('95', 'Colt', '7');
INSERT INTO `car_model` VALUES ('96', 'Eclipse', '7');
INSERT INTO `car_model` VALUES ('97', 'Galant', '7');
INSERT INTO `car_model` VALUES ('103', 'Lancer', '7');
INSERT INTO `car_model` VALUES ('104', 'Outlander', '7');
INSERT INTO `car_model` VALUES ('105', 'Pajero', '7');
INSERT INTO `car_model` VALUES ('106', 'Space', '7');
INSERT INTO `car_model` VALUES ('107', '147', '8');
INSERT INTO `car_model` VALUES ('108', '156', '8');
INSERT INTO `car_model` VALUES ('109', '159', '8');
INSERT INTO `car_model` VALUES ('110', '166', '8');
INSERT INTO `car_model` VALUES ('111', 'Giulia', '8');
INSERT INTO `car_model` VALUES ('112', 'Giulietta', '8');
INSERT INTO `car_model` VALUES ('113', 'GT', '8');
INSERT INTO `car_model` VALUES ('114', 'MiTo', '8');
INSERT INTO `car_model` VALUES ('115', 'Stelvio', '8');
INSERT INTO `car_model` VALUES ('116', 'DB9', '9');
INSERT INTO `car_model` VALUES ('117', 'DB11', '9');
INSERT INTO `car_model` VALUES ('118', 'Rapide', '9');
INSERT INTO `car_model` VALUES ('119', 'V8 Vantage', '9');
INSERT INTO `car_model` VALUES ('120', 'Vanquish', '9');
INSERT INTO `car_model` VALUES ('121', 'Bentayga', '10');
INSERT INTO `car_model` VALUES ('122', 'Continental', '10');
INSERT INTO `car_model` VALUES ('123', 'Aveo', '12');
INSERT INTO `car_model` VALUES ('124', 'Camaro', '12');
INSERT INTO `car_model` VALUES ('125', 'Captiva', '12');
INSERT INTO `car_model` VALUES ('126', 'Corvette', '12');
INSERT INTO `car_model` VALUES ('127', 'Cruze', '12');
INSERT INTO `car_model` VALUES ('128', 'Impala', '12');
INSERT INTO `car_model` VALUES ('129', 'Lacetti', '12');
INSERT INTO `car_model` VALUES ('130', 'Matiz', '12');
INSERT INTO `car_model` VALUES ('131', 'Spark', '12');
INSERT INTO `car_model` VALUES ('132', '300C', '13');
INSERT INTO `car_model` VALUES ('133', 'Grand Voyager', '13');
INSERT INTO `car_model` VALUES ('134', 'PT Cruiser', '13');
INSERT INTO `car_model` VALUES ('135', 'Voyager', '13');
INSERT INTO `car_model` VALUES ('136', 'Berlingo', '14');
INSERT INTO `car_model` VALUES ('137', 'C1', '14');
INSERT INTO `car_model` VALUES ('138', 'C2', '14');
INSERT INTO `car_model` VALUES ('139', 'C3', '14');
INSERT INTO `car_model` VALUES ('140', 'C4', '14');
INSERT INTO `car_model` VALUES ('141', 'C5', '14');
INSERT INTO `car_model` VALUES ('142', 'C6', '14');
INSERT INTO `car_model` VALUES ('143', 'C8', '14');
INSERT INTO `car_model` VALUES ('144', 'DS3', '14');
INSERT INTO `car_model` VALUES ('145', 'DS4', '14');
INSERT INTO `car_model` VALUES ('146', 'DS5', '14');
INSERT INTO `car_model` VALUES ('147', 'Duster', '15');
INSERT INTO `car_model` VALUES ('148', 'Logan', '15');
INSERT INTO `car_model` VALUES ('149', 'Sandero', '15');
INSERT INTO `car_model` VALUES ('150', 'Lanos', '16');
INSERT INTO `car_model` VALUES ('151', 'Matiz', '16');
INSERT INTO `car_model` VALUES ('152', 'Tico', '16');
INSERT INTO `car_model` VALUES ('153', 'Challenger', '17');
INSERT INTO `car_model` VALUES ('154', 'Charger', '17');
INSERT INTO `car_model` VALUES ('155', 'RAM', '17');
INSERT INTO `car_model` VALUES ('156', 'Viper', '17');
INSERT INTO `car_model` VALUES ('157', '125p', '18');
INSERT INTO `car_model` VALUES ('158', '126', '18');
INSERT INTO `car_model` VALUES ('159', '500', '18');
INSERT INTO `car_model` VALUES ('160', 'Bravo', '18');
INSERT INTO `car_model` VALUES ('161', 'Cinquecento', '18');
INSERT INTO `car_model` VALUES ('162', 'Croma', '18');
INSERT INTO `car_model` VALUES ('163', 'Doblo', '18');
INSERT INTO `car_model` VALUES ('164', 'Freemont', '18');
INSERT INTO `car_model` VALUES ('165', 'Punto', '18');
INSERT INTO `car_model` VALUES ('166', 'Multipla', '18');
INSERT INTO `car_model` VALUES ('167', 'Panda', '18');
INSERT INTO `car_model` VALUES ('168', 'Seicento', '18');
INSERT INTO `car_model` VALUES ('169', 'Tipo', '18');
INSERT INTO `car_model` VALUES ('170', 'Uno', '18');
INSERT INTO `car_model` VALUES ('171', 'C-MAX', '19');
INSERT INTO `car_model` VALUES ('172', 'Escort', '19');
INSERT INTO `car_model` VALUES ('173', 'F150', '19');
INSERT INTO `car_model` VALUES ('174', 'Fiesta', '19');
INSERT INTO `car_model` VALUES ('175', 'Focus', '19');
INSERT INTO `car_model` VALUES ('176', 'Fusion', '19');
INSERT INTO `car_model` VALUES ('177', 'Galaxy', '19');
INSERT INTO `car_model` VALUES ('178', 'KA', '19');
INSERT INTO `car_model` VALUES ('179', 'Kuga', '19');
INSERT INTO `car_model` VALUES ('180', 'Mondeo', '19');
INSERT INTO `car_model` VALUES ('181', 'Mustang', '19');
INSERT INTO `car_model` VALUES ('182', 'Transit', '19');
INSERT INTO `car_model` VALUES ('183', 'Accord', '20');
INSERT INTO `car_model` VALUES ('184', 'Civic', '20');
INSERT INTO `car_model` VALUES ('185', 'CR-V', '20');
INSERT INTO `car_model` VALUES ('186', 'CR-Z', '20');
INSERT INTO `car_model` VALUES ('187', 'HR-V', '20');
INSERT INTO `car_model` VALUES ('188', 'Jazz', '20');
INSERT INTO `car_model` VALUES ('189', 'S2000', '20');
INSERT INTO `car_model` VALUES ('190', 'H1', '21');
INSERT INTO `car_model` VALUES ('191', 'H2', '21');
INSERT INTO `car_model` VALUES ('192', 'H3', '21');
INSERT INTO `car_model` VALUES ('193', 'Coupe', '22');
INSERT INTO `car_model` VALUES ('194', 'Elantra', '22');
INSERT INTO `car_model` VALUES ('195', 'Genesis', '22');
INSERT INTO `car_model` VALUES ('196', 'Santa Fe', '22');
INSERT INTO `car_model` VALUES ('197', 'i20', '22');
INSERT INTO `car_model` VALUES ('198', 'i30', '22');
INSERT INTO `car_model` VALUES ('199', 'i40', '22');
INSERT INTO `car_model` VALUES ('200', 'ix20', '22');
INSERT INTO `car_model` VALUES ('201', 'ix35', '22');
INSERT INTO `car_model` VALUES ('202', 'ix55', '22');
INSERT INTO `car_model` VALUES ('203', 'Matrix', '22');
INSERT INTO `car_model` VALUES ('204', 'Sonata', '22');
INSERT INTO `car_model` VALUES ('205', 'Tucson', '22');
INSERT INTO `car_model` VALUES ('206', 'FX', '23');
INSERT INTO `car_model` VALUES ('207', 'Q30', '23');
INSERT INTO `car_model` VALUES ('208', 'Q50', '23');
INSERT INTO `car_model` VALUES ('209', 'QX70', '23');
INSERT INTO `car_model` VALUES ('210', 'F-Pace', '24');
INSERT INTO `car_model` VALUES ('211', 'E-Pace', '24');
INSERT INTO `car_model` VALUES ('212', 'S-Type', '24');
INSERT INTO `car_model` VALUES ('213', 'X-Type', '24');
INSERT INTO `car_model` VALUES ('214', 'XE', '24');
INSERT INTO `car_model` VALUES ('215', 'XF', '24');
INSERT INTO `car_model` VALUES ('216', 'XJ', '24');
INSERT INTO `car_model` VALUES ('217', 'XK', '24');
INSERT INTO `car_model` VALUES ('218', 'Cherokee', '25');
INSERT INTO `car_model` VALUES ('219', 'Compass', '25');
INSERT INTO `car_model` VALUES ('220', 'Grand Cherokee', '25');
INSERT INTO `car_model` VALUES ('221', 'Renegade', '25');
INSERT INTO `car_model` VALUES ('222', 'Wrangler', '25');
INSERT INTO `car_model` VALUES ('223', 'Cee\'d', '26');
INSERT INTO `car_model` VALUES ('224', 'Optima', '26');
INSERT INTO `car_model` VALUES ('225', 'Picanto', '26');
INSERT INTO `car_model` VALUES ('226', 'Rio', '26');
INSERT INTO `car_model` VALUES ('227', 'Sorento', '26');
INSERT INTO `car_model` VALUES ('228', 'Sportage', '26');
INSERT INTO `car_model` VALUES ('229', 'Aventador', '27');
INSERT INTO `car_model` VALUES ('230', 'Gallardo', '27');
INSERT INTO `car_model` VALUES ('231', 'Huracan', '27');
INSERT INTO `car_model` VALUES ('232', 'Murcielago', '27');
INSERT INTO `car_model` VALUES ('233', 'Delta', '28');
INSERT INTO `car_model` VALUES ('234', 'Ypsilon', '28');
INSERT INTO `car_model` VALUES ('235', 'Defender', '29');
INSERT INTO `car_model` VALUES ('236', 'Discovery', '29');
INSERT INTO `car_model` VALUES ('237', 'Freelander', '29');
INSERT INTO `car_model` VALUES ('238', 'Range Rover', '29');
INSERT INTO `car_model` VALUES ('239', 'Evoque', '29');
INSERT INTO `car_model` VALUES ('240', 'Velar', '29');
INSERT INTO `car_model` VALUES ('241', 'Sport', '29');
INSERT INTO `car_model` VALUES ('242', 'GS', '30');
INSERT INTO `car_model` VALUES ('243', 'IS', '30');
INSERT INTO `car_model` VALUES ('244', 'LS', '30');
INSERT INTO `car_model` VALUES ('245', 'NX', '30');
INSERT INTO `car_model` VALUES ('246', 'RX', '30');
INSERT INTO `car_model` VALUES ('247', 'Ghibli', '31');
INSERT INTO `car_model` VALUES ('248', 'GranTurismo', '31');
INSERT INTO `car_model` VALUES ('249', 'Quattroporte', '31');
INSERT INTO `car_model` VALUES ('250', '2', '32');
INSERT INTO `car_model` VALUES ('251', '3', '32');
INSERT INTO `car_model` VALUES ('252', '5', '32');
INSERT INTO `car_model` VALUES ('253', '6', '32');
INSERT INTO `car_model` VALUES ('254', '626', '32');
INSERT INTO `car_model` VALUES ('255', 'CX-3', '32');
INSERT INTO `car_model` VALUES ('256', 'CX-5', '32');
INSERT INTO `car_model` VALUES ('257', 'CX-7', '32');
INSERT INTO `car_model` VALUES ('258', 'CX-9', '32');
INSERT INTO `car_model` VALUES ('259', 'MX-5', '32');
INSERT INTO `car_model` VALUES ('260', 'RX-7', '32');
INSERT INTO `car_model` VALUES ('261', 'RX-8', '32');
INSERT INTO `car_model` VALUES ('262', 'Klasa A', '33');
INSERT INTO `car_model` VALUES ('263', 'Klasa B', '33');
INSERT INTO `car_model` VALUES ('264', 'Klasa C', '33');
INSERT INTO `car_model` VALUES ('265', 'Klasa E', '33');
INSERT INTO `car_model` VALUES ('266', 'Klasa G', '33');
INSERT INTO `car_model` VALUES ('267', 'Klasa R', '33');
INSERT INTO `car_model` VALUES ('268', 'Klasa S', '33');
INSERT INTO `car_model` VALUES ('269', 'Klasa V', '33');
INSERT INTO `car_model` VALUES ('270', 'Klasa X', '33');
INSERT INTO `car_model` VALUES ('271', 'CLA', '33');
INSERT INTO `car_model` VALUES ('272', 'CLK', '33');
INSERT INTO `car_model` VALUES ('273', 'CLS', '33');
INSERT INTO `car_model` VALUES ('274', 'GLA', '33');
INSERT INTO `car_model` VALUES ('275', 'GLC', '33');
INSERT INTO `car_model` VALUES ('276', 'GLE', '33');
INSERT INTO `car_model` VALUES ('277', 'GLK', '33');
INSERT INTO `car_model` VALUES ('278', 'ML', '33');
INSERT INTO `car_model` VALUES ('279', 'SLK', '33');
INSERT INTO `car_model` VALUES ('280', 'AMG GT', '33');
INSERT INTO `car_model` VALUES ('281', 'Sprinter', '33');
INSERT INTO `car_model` VALUES ('282', 'W124', '33');
INSERT INTO `car_model` VALUES ('283', 'Clubman', '34');
INSERT INTO `car_model` VALUES ('284', 'Cooper', '34');
INSERT INTO `car_model` VALUES ('285', 'Cooper S', '34');
INSERT INTO `car_model` VALUES ('286', 'Countryman', '34');
INSERT INTO `car_model` VALUES ('287', 'ONE', '34');
INSERT INTO `car_model` VALUES ('288', 'Adam', '35');
INSERT INTO `car_model` VALUES ('289', 'Astra', '35');
INSERT INTO `car_model` VALUES ('290', 'Combo', '35');
INSERT INTO `car_model` VALUES ('291', 'Corsa', '35');
INSERT INTO `car_model` VALUES ('292', 'Frontera', '35');
INSERT INTO `car_model` VALUES ('293', 'Insignia', '35');
INSERT INTO `car_model` VALUES ('294', 'Meriva', '35');
INSERT INTO `car_model` VALUES ('295', 'Mokka', '35');
INSERT INTO `car_model` VALUES ('296', 'Omega', '35');
INSERT INTO `car_model` VALUES ('297', 'Vectra', '35');
INSERT INTO `car_model` VALUES ('298', 'Zafira', '35');
INSERT INTO `car_model` VALUES ('299', '106', '36');
INSERT INTO `car_model` VALUES ('300', '107', '36');
INSERT INTO `car_model` VALUES ('301', '206', '36');
INSERT INTO `car_model` VALUES ('302', '207', '36');
INSERT INTO `car_model` VALUES ('303', '208', '36');
INSERT INTO `car_model` VALUES ('304', '306', '36');
INSERT INTO `car_model` VALUES ('305', '307', '36');
INSERT INTO `car_model` VALUES ('306', '308', '36');
INSERT INTO `car_model` VALUES ('307', '407', '36');
INSERT INTO `car_model` VALUES ('308', '508', '36');
INSERT INTO `car_model` VALUES ('309', '607', '36');
INSERT INTO `car_model` VALUES ('310', '807', '36');
INSERT INTO `car_model` VALUES ('311', '2008', '36');
INSERT INTO `car_model` VALUES ('312', '3008', '36');
INSERT INTO `car_model` VALUES ('313', '5008', '36');
INSERT INTO `car_model` VALUES ('314', 'Partner', '36');
INSERT INTO `car_model` VALUES ('315', 'Polonez', '37');
INSERT INTO `car_model` VALUES ('316', 'Caro', '37');
INSERT INTO `car_model` VALUES ('317', 'Firebird', '38');
INSERT INTO `car_model` VALUES ('318', 'GTO', '38');
INSERT INTO `car_model` VALUES ('319', '718', '39');
INSERT INTO `car_model` VALUES ('320', '911', '39');
INSERT INTO `car_model` VALUES ('321', 'Boxster', '39');
INSERT INTO `car_model` VALUES ('322', 'Cayenne', '39');
INSERT INTO `car_model` VALUES ('323', 'Cayman', '39');
INSERT INTO `car_model` VALUES ('324', 'Panamera', '39');
INSERT INTO `car_model` VALUES ('325', 'Kadjar', '40');
INSERT INTO `car_model` VALUES ('326', 'Captur', '40');
INSERT INTO `car_model` VALUES ('327', 'Clio', '40');
INSERT INTO `car_model` VALUES ('328', 'Espace', '40');
INSERT INTO `car_model` VALUES ('329', 'Kangoo', '40');
INSERT INTO `car_model` VALUES ('330', 'Koleos', '40');
INSERT INTO `car_model` VALUES ('331', 'Laguna', '40');
INSERT INTO `car_model` VALUES ('332', 'Megane', '40');
INSERT INTO `car_model` VALUES ('333', 'Scenic', '40');
INSERT INTO `car_model` VALUES ('334', 'Talisman', '40');
INSERT INTO `car_model` VALUES ('335', 'Twingo', '40');
INSERT INTO `car_model` VALUES ('336', 'Dawn', '41');
INSERT INTO `car_model` VALUES ('337', 'Ghost', '41');
INSERT INTO `car_model` VALUES ('338', 'Wraith', '41');
INSERT INTO `car_model` VALUES ('339', 'Shadow', '41');
INSERT INTO `car_model` VALUES ('340', '25', '42');
INSERT INTO `car_model` VALUES ('341', '45', '42');
INSERT INTO `car_model` VALUES ('342', '75', '42');
INSERT INTO `car_model` VALUES ('343', '9-3', '43');
INSERT INTO `car_model` VALUES ('344', '9-5', '43');
INSERT INTO `car_model` VALUES ('345', '900', '43');
INSERT INTO `car_model` VALUES ('346', 'Altea', '44');
INSERT INTO `car_model` VALUES ('347', 'Arona', '44');
INSERT INTO `car_model` VALUES ('348', 'Cordoba', '44');
INSERT INTO `car_model` VALUES ('349', 'Ibiza', '44');
INSERT INTO `car_model` VALUES ('350', 'Inca', '44');
INSERT INTO `car_model` VALUES ('351', 'Leon', '44');
INSERT INTO `car_model` VALUES ('352', 'Toledo', '44');
INSERT INTO `car_model` VALUES ('353', 'Fabia', '45');
INSERT INTO `car_model` VALUES ('354', 'Felicia', '45');
INSERT INTO `car_model` VALUES ('355', 'Karoq', '45');
INSERT INTO `car_model` VALUES ('356', 'Kodiaq', '45');
INSERT INTO `car_model` VALUES ('357', 'Octavia', '45');
INSERT INTO `car_model` VALUES ('358', 'Rapid', '45');
INSERT INTO `car_model` VALUES ('359', 'Superb', '45');
INSERT INTO `car_model` VALUES ('360', 'Yeti', '45');
INSERT INTO `car_model` VALUES ('361', 'Forfour', '46');
INSERT INTO `car_model` VALUES ('362', 'Fortwo', '46');
INSERT INTO `car_model` VALUES ('363', 'Roadster', '46');
INSERT INTO `car_model` VALUES ('364', 'BRZ', '47');
INSERT INTO `car_model` VALUES ('365', 'Forester', '47');
INSERT INTO `car_model` VALUES ('366', 'Impreza', '47');
INSERT INTO `car_model` VALUES ('367', 'Legacy', '47');
INSERT INTO `car_model` VALUES ('368', 'Outback', '47');
INSERT INTO `car_model` VALUES ('369', 'Grand Vitara', '48');
INSERT INTO `car_model` VALUES ('370', 'Jimny', '48');
INSERT INTO `car_model` VALUES ('371', 'Swift', '48');
INSERT INTO `car_model` VALUES ('372', 'SX4', '48');
INSERT INTO `car_model` VALUES ('373', 'Vitara', '48');
INSERT INTO `car_model` VALUES ('374', 'Model S', '49');
INSERT INTO `car_model` VALUES ('375', 'Model 3', '49');
INSERT INTO `car_model` VALUES ('376', 'Model X', '49');
INSERT INTO `car_model` VALUES ('377', 'Roadster', '49');
INSERT INTO `car_model` VALUES ('378', 'Auris', '50');
INSERT INTO `car_model` VALUES ('379', 'Avensis', '50');
INSERT INTO `car_model` VALUES ('380', 'Aygo', '50');
INSERT INTO `car_model` VALUES ('381', 'C-HR', '50');
INSERT INTO `car_model` VALUES ('382', 'Celica', '50');
INSERT INTO `car_model` VALUES ('383', 'Corolla', '50');
INSERT INTO `car_model` VALUES ('384', 'GT86', '50');
INSERT INTO `car_model` VALUES ('385', 'Hilux', '50');
INSERT INTO `car_model` VALUES ('386', 'Land Cruiser', '50');
INSERT INTO `car_model` VALUES ('387', 'Prius', '50');
INSERT INTO `car_model` VALUES ('388', 'RAV4', '50');
INSERT INTO `car_model` VALUES ('389', 'Supra', '50');
INSERT INTO `car_model` VALUES ('390', 'Yaris', '50');
INSERT INTO `car_model` VALUES ('391', 'C30', '51');
INSERT INTO `car_model` VALUES ('392', 'C70', '51');
INSERT INTO `car_model` VALUES ('393', 'S40', '51');
INSERT INTO `car_model` VALUES ('394', 'S80', '51');
INSERT INTO `car_model` VALUES ('395', 'S90', '51');
INSERT INTO `car_model` VALUES ('396', 'V40', '51');
INSERT INTO `car_model` VALUES ('397', 'V50', '51');
INSERT INTO `car_model` VALUES ('398', 'V60', '51');
INSERT INTO `car_model` VALUES ('399', 'V70', '51');
INSERT INTO `car_model` VALUES ('400', 'V90', '51');
INSERT INTO `car_model` VALUES ('401', 'XC 40', '51');
INSERT INTO `car_model` VALUES ('402', 'XC 60', '51');
INSERT INTO `car_model` VALUES ('403', 'XC 70', '51');
INSERT INTO `car_model` VALUES ('404', 'XC 90', '51');

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id_cat` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_cat`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', 'News');
INSERT INTO `category` VALUES ('2', 'Test');
INSERT INTO `category` VALUES ('3', 'CarBattle');
INSERT INTO `category` VALUES ('4', 'Porada');
INSERT INTO `category` VALUES ('5', 'Historia');

-- ----------------------------
-- Table structure for `comment`
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id_com` int(5) NOT NULL AUTO_INCREMENT,
  `id_user` int(5) NOT NULL,
  `comment` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_article` int(5) NOT NULL,
  PRIMARY KEY (`id_com`),
  KEY `com-art` (`id_article`),
  KEY `com_usr` (`id_user`),
  CONSTRAINT `com_art` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_text`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `com_usr` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comment
-- ----------------------------
INSERT INTO `comment` VALUES ('21', '13', 'Testowy komentarz 001', '2018-03-06 16:01:32', '17');
INSERT INTO `comment` VALUES ('22', '12', 'Testowy komentarz 002', '2018-03-06 16:02:00', '17');
INSERT INTO `comment` VALUES ('23', '14', '@Test54 Testowa odpowiedź 001', '2018-03-06 16:02:30', '17');
INSERT INTO `comment` VALUES ('24', '12', 'Test 001', '2018-03-25 13:27:12', '20');
INSERT INTO `comment` VALUES ('25', '12', 'Test 002', '2018-03-25 13:27:18', '20');

-- ----------------------------
-- Table structure for `drive`
-- ----------------------------
DROP TABLE IF EXISTS `drive`;
CREATE TABLE `drive` (
  `id_drive` int(5) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id_drive`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of drive
-- ----------------------------
INSERT INTO `drive` VALUES ('1', '4x4 - stałe');
INSERT INTO `drive` VALUES ('2', '4x4 - automatyczne');
INSERT INTO `drive` VALUES ('3', '4x4 - ręczne');
INSERT INTO `drive` VALUES ('4', 'Przód');
INSERT INTO `drive` VALUES ('5', 'Tył');

-- ----------------------------
-- Table structure for `fotki`
-- ----------------------------
DROP TABLE IF EXISTS `fotki`;
CREATE TABLE `fotki` (
  `name` varchar(30) NOT NULL,
  `id_art` int(5) DEFAULT NULL,
  `id_car` int(5) DEFAULT NULL,
  KEY `fot_art` (`id_art`),
  KEY `fot_car` (`id_car`),
  CONSTRAINT `fot_art` FOREIGN KEY (`id_art`) REFERENCES `article` (`id_text`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fot_car` FOREIGN KEY (`id_car`) REFERENCES `car` (`id_car`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fotki
-- ----------------------------
INSERT INTO `fotki` VALUES ('1520343653110.jpg', null, '58');
INSERT INTO `fotki` VALUES ('1520343653111.jpg', null, '58');
INSERT INTO `fotki` VALUES ('1520343653112.jpg', null, '58');
INSERT INTO `fotki` VALUES ('1520343654113.jpg', null, '58');
INSERT INTO `fotki` VALUES ('1520343654114.jpg', null, '58');
INSERT INTO `fotki` VALUES ('1520343654115.jpg', null, '58');
INSERT INTO `fotki` VALUES ('1520343905110.jpg', null, '59');
INSERT INTO `fotki` VALUES ('1520343905111.jpg', null, '59');
INSERT INTO `fotki` VALUES ('1520343905112.jpg', null, '59');
INSERT INTO `fotki` VALUES ('1520343905113.jpg', null, '59');
INSERT INTO `fotki` VALUES ('1520344278120.jpg', null, '60');
INSERT INTO `fotki` VALUES ('1520344278121.jpg', null, '60');
INSERT INTO `fotki` VALUES ('1520344278122.jpg', null, '60');
INSERT INTO `fotki` VALUES ('1520344278123.jpg', null, '60');
INSERT INTO `fotki` VALUES ('1520344278124.jpg', null, '60');
INSERT INTO `fotki` VALUES ('1520344278125.jpg', null, '60');
INSERT INTO `fotki` VALUES ('1520346136120.jpg', null, '62');
INSERT INTO `fotki` VALUES ('1520346136121.jpg', null, '62');
INSERT INTO `fotki` VALUES ('1520346435130.jpg', null, '63');
INSERT INTO `fotki` VALUES ('1520348095110.jpg', null, '64');
INSERT INTO `fotki` VALUES ('1520348095111.jpg', null, '64');
INSERT INTO `fotki` VALUES ('1520348385140.jpg', '17', null);
INSERT INTO `fotki` VALUES ('1520348385141.jpg', '17', null);
INSERT INTO `fotki` VALUES ('1520348385142.jpg', '17', null);
INSERT INTO `fotki` VALUES ('1520348742140.jpg', '18', null);
INSERT INTO `fotki` VALUES ('1520348742141.jpg', '18', null);
INSERT INTO `fotki` VALUES ('1520348742142.jpg', '18', null);
INSERT INTO `fotki` VALUES ('1520349283140.JPG', '19', null);
INSERT INTO `fotki` VALUES ('1520349283141.jpg', '19', null);
INSERT INTO `fotki` VALUES ('1520349283142.jpg', '19', null);
INSERT INTO `fotki` VALUES ('1520349440140.jpg', '20', null);
INSERT INTO `fotki` VALUES ('1520349440141.JPG', '20', null);
INSERT INTO `fotki` VALUES ('1520349440142.JPG', '20', null);
INSERT INTO `fotki` VALUES ('1520349440144.jpg', '20', null);
INSERT INTO `fotki` VALUES ('1520349440145.jpg', '20', null);
INSERT INTO `fotki` VALUES ('1520349440146.jpg', '20', null);
INSERT INTO `fotki` VALUES ('1520349440147.jpg', '20', null);

-- ----------------------------
-- Table structure for `fuel`
-- ----------------------------
DROP TABLE IF EXISTS `fuel`;
CREATE TABLE `fuel` (
  `id_pal` int(5) NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id_pal`),
  FULLTEXT KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fuel
-- ----------------------------
INSERT INTO `fuel` VALUES ('1', 'Benzyna');
INSERT INTO `fuel` VALUES ('2', 'Diesel');
INSERT INTO `fuel` VALUES ('3', 'Elektryczny');
INSERT INTO `fuel` VALUES ('4', 'Hybryda');
INSERT INTO `fuel` VALUES ('5', 'LPG');

-- ----------------------------
-- Table structure for `gearbox`
-- ----------------------------
DROP TABLE IF EXISTS `gearbox`;
CREATE TABLE `gearbox` (
  `id_gearbox` int(5) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id_gearbox`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of gearbox
-- ----------------------------
INSERT INTO `gearbox` VALUES ('1', 'Automat');
INSERT INTO `gearbox` VALUES ('2', 'Manual');

-- ----------------------------
-- Table structure for `options`
-- ----------------------------
DROP TABLE IF EXISTS `options`;
CREATE TABLE `options` (
  `id_option` int(5) NOT NULL AUTO_INCREMENT,
  `prod_date` int(4) NOT NULL,
  `id_pal` int(5) NOT NULL,
  `mileage` int(10) NOT NULL,
  `netto` int(1) NOT NULL,
  `price` int(10) NOT NULL,
  `negotiable` varchar(1) NOT NULL,
  `country` varchar(20) NOT NULL,
  `damaged` varchar(1) NOT NULL,
  `oc` int(1) NOT NULL,
  `reg` varchar(1) NOT NULL,
  `vat` varchar(1) NOT NULL,
  `leasing` varchar(1) NOT NULL,
  `engine` int(5) NOT NULL,
  `bHP` int(5) NOT NULL,
  `id_gearbox` int(5) NOT NULL,
  `id_drive` int(5) NOT NULL,
  `color` varchar(20) NOT NULL,
  `id_type` int(5) NOT NULL,
  `status` varchar(1) NOT NULL,
  `opis` varchar(4096) NOT NULL DEFAULT 'Brak opisu',
  `firstowner` int(1) NOT NULL,
  `aso` int(1) NOT NULL,
  `noacc` int(1) NOT NULL,
  `foto` varchar(40) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `city` varchar(30) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `watched` int(10) NOT NULL DEFAULT '0',
  `views` int(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_option`),
  KEY `opt-fue` (`id_pal`),
  KEY `opt-gea` (`id_gearbox`),
  KEY `opt-dri` (`id_drive`),
  KEY `opt-typ` (`id_type`),
  CONSTRAINT `opt-dri` FOREIGN KEY (`id_drive`) REFERENCES `drive` (`id_drive`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `opt-fue` FOREIGN KEY (`id_pal`) REFERENCES `fuel` (`id_pal`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `opt-gea` FOREIGN KEY (`id_gearbox`) REFERENCES `gearbox` (`id_gearbox`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `opt-typ` FOREIGN KEY (`id_type`) REFERENCES `type` (`id_type`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of options
-- ----------------------------
INSERT INTO `options` VALUES ('21', '2017', '2', '1', '0', '140000', '0', 'Niemcy', '0', '0', '0', '1', '1', '2300', '170', '1', '4', 'Czerwony', '2', '1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris fringilla lobortis convallis. Proin porttitor suscipit efficitur. Maecenas convallis tristique arcu ut cursus. Donec in efficitur lacus. Suspendisse porta massa tortor, et pellentesque quam suscipit quis. Suspendisse eu dolor egestas, dignissim turpis dignissim, tristique ante. Nullam et lorem luctus, suscipit dui in, sodales metus. Maecenas maximus dictum egestas. Morbi quis lobortis quam. Etiam sed ante et nunc sodales egestas. Aenean luctus vel ante eu fermentum. Morbi quis posuere mi.\r\n\r\nPellentesque porttitor orci in dui consectetur, sit amet laoreet nunc mattis. Suspendisse sed tincidunt lacus. Fusce tincidunt sodales sapien, consequat dictum purus. Nullam erat libero, condimentum sit amet erat vitae, semper viverra ante. Aenean non dolor nunc. In eu laoreet urna. Sed quis semper ex, at rutrum tortor. Ut porta tristique ex vel consequat. Mauris a elit semper, facilisis purus nec, semper est. In id cursus dolor, eget placerat eros.\r\n\r\nAenean accumsan felis eu congue hendrerit. Nullam id sapien justo. In iaculis ipsum ut ex gravida elementum. Sed nisi turpis, commodo a sem sed, posuere pretium diam. Quisque a consequat dui. Interdum et malesuada fames ac ante ipsum primis in faucibus. Morbi a tincidunt dolor, sit amet viverra orci. Nullam leo erat, pulvinar quis interdum nec, blandit ultrices leo. Vestibulum efficitur efficitur risus et fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc ullamcorper, dui ut mollis vestibulum, neque tellus laoreet nunc, sit amet dapibus risus erat ut libero. Vivamus ipsum justo, aliquet eu finibus at, viverra sit amet mi.', '0', '0', '1', '1520343653.jpg', '32-432', 'Pcim', '312645867', '1', '6');
INSERT INTO `options` VALUES ('22', '2012', '1', '160000', '0', '100000', '1', 'Włochy', '0', '1', '1', '0', '0', '2500', '245', '2', '1', 'Czerwony', '1', '0', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque et magna a ipsum interdum venenatis eu sit amet est. Proin non dolor vestibulum, venenatis ex vel, tempor sapien. Fusce feugiat risus turpis, nec ullamcorper diam molestie in. Cras dictum ante eget sodales sodales. Nulla sed pretium eros. Praesent aliquam augue sit amet ipsum aliquet varius. Aenean vitae urna magna.\r\n\r\nAenean sed pharetra risus. Mauris volutpat leo odio, eu mattis sapien mattis a. Donec finibus diam consectetur, hendrerit libero quis, tincidunt nunc. Cras lacinia tellus in blandit viverra. Aliquam nunc felis, lacinia ac aliquet sit amet, viverra ac risus. Pellentesque at erat sit amet felis venenatis accumsan. Aliquam luctus tortor et vestibulum vehicula. Sed vitae cursus justo. Maecenas id est turpis. Vestibulum interdum consequat nisi eget finibus. Pellentesque volutpat leo eros, ac egestas nibh fringilla sit amet. In cursus et orci et scelerisque. In imperdiet rutrum dui eu laoreet. Ut imperdiet ac dui porta ullamcorper.\r\n\r\nPellentesque interdum nec magna ac commodo. Vestibulum eget lacus aliquam, cursus ligula eget, pharetra diam. Nunc finibus placerat ante, vel sagittis ligula. Proin pellentesque pulvinar sem a mollis. Nunc interdum velit eros, sed viverra tortor semper a. Vestibulum rhoncus orci sed odio cursus, id tincidunt libero lobortis. Morbi efficitur, nibh vitae tincidunt venenatis, velit enim viverra nunc, nec condimentum lacus risus a dui. Cras sodales, nisi sed fermentum elementum, dui erat euismod risus, ac elementum libero nisl id purus. Fusce lacus nibh, sagittis vel varius id, dapibus non lectus. Donec non ante suscipit tellus volutpat varius. Nunc auctor sagittis tortor, id vehicula nunc varius sit amet.\r\n\r\nMorbi rutrum ipsum libero, et cursus eros rutrum sed. Sed fringilla lacinia felis vel interdum. Integer finibus sapien enim, non egestas velit condimentum sit amet. Sed id massa turpis. Nunc pellentesque odio vitae convallis vestibulum. Sed auctor laoreet justo at iaculis. Nam vulputate sapien nec mi posuere molestie. Etiam eget tellus magna.', '1', '1', '0', '1520343904.jpg', '32-432', 'Pcim', '312645867', '2', '10');
INSERT INTO `options` VALUES ('23', '2018', '4', '10', '0', '90000', '0', 'Japonia', '0', '0', '0', '1', '1', '1600', '160', '1', '4', 'Bordowy', '8', '1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dictum eget orci sit amet ornare. Quisque eget ultricies ligula. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin dui ligula, tristique eget odio a, tristique molestie sem. Nunc lobortis purus vitae lobortis tempus. Fusce purus tortor, tincidunt id ex non, placerat viverra lacus. In hac habitasse platea dictumst.\r\n\r\nQuisque tincidunt auctor scelerisque. Vestibulum vel nibh congue, accumsan lectus in, mattis urna. Ut convallis est quam. Sed cursus aliquam viverra. Integer eros nulla, ornare ac leo a, aliquet pharetra lacus. Nulla nibh tortor, mattis ut sem quis, pulvinar molestie nisi. Vestibulum faucibus turpis augue, a dictum leo rhoncus eu. Integer in pellentesque ante. Sed egestas urna lobortis nisi vehicula efficitur. Etiam sit amet consequat nunc. Morbi blandit gravida lacus, eget rutrum libero aliquet quis. Duis non massa ac urna semper congue. Curabitur neque nisi, ullamcorper sit amet vulputate vel, vehicula nec odio. Praesent vitae dui a ipsum sodales dignissim. Nullam a metus ac leo interdum ullamcorper tempor a diam.\r\n\r\nEtiam eget mauris vitae tortor accumsan sagittis ut ut justo. Aliquam purus mauris, tincidunt iaculis libero nec, volutpat tristique arcu. Aliquam convallis sed justo luctus mollis. Ut tincidunt tempus massa at dignissim. Sed aliquam euismod consectetur. Curabitur dui massa, rhoncus luctus sapien sit amet, tincidunt semper tortor. Vestibulum posuere odio non lobortis fringilla. Quisque sed vehicula quam. Sed dolor quam, cursus sed consectetur vitae, semper et tellus.\r\n\r\nAenean dictum lorem eu lacus consectetur aliquam. Etiam nisl lacus, ultricies eget gravida vel, dictum sit amet nisl. Integer ultricies dolor a commodo sollicitudin. Nam blandit id magna lobortis condimentum. Vivamus ullamcorper eu neque et ultricies. Nunc rhoncus quam elit, sed pharetra metus sagittis non. Mauris quis porttitor neque. Nulla facilisi. Duis sit amet mauris pellentesque, accumsan tellus quis, tempor ante. Nullam sagittis ipsum sapien, id lacinia tellus commodo at. Quisque feugiat vel lacus quis vehicula. Morbi tempus mollis molestie. In hac habitasse platea dictumst. Nullam sit amet sollicitudin nunc. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed nec justo in enim porttitor sodales.', '0', '0', '1', '1520344278.jpg', '66-450', 'Bogdaniec', '132465798', '0', '4');
INSERT INTO `options` VALUES ('25', '1998', '5', '350000', '0', '15750', '0', 'Polska', '0', '1', '1', '0', '0', '2400', '200', '2', '4', 'Niebieski', '1', '0', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget nisl eu sem varius condimentum vel commodo ipsum. Cras turpis lectus, imperdiet vel tortor ut, euismod cursus justo. Proin eu sem eu sapien scelerisque molestie in sit amet ex. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec consectetur vulputate neque, non porttitor lacus. Ut urna sem, cursus a vehicula a, dapibus nec nisl. Mauris porta posuere quam, quis rhoncus orci imperdiet sit amet. Nam lacinia tristique dui, ornare pretium neque convallis in. Integer ut nunc dolor. Nulla facilisi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;\r\n\r\nPellentesque tempus dignissim ante et scelerisque. Suspendisse ac ante tempus, varius nunc ut, sollicitudin quam. Proin rhoncus condimentum ante, vel tincidunt massa pulvinar sit amet. Quisque quis arcu sit amet purus suscipit accumsan et ac dui. Proin ac sapien sodales, efficitur neque nec, pharetra arcu. Mauris mi nisl, eleifend quis faucibus sed, sagittis sit amet urna. Cras id ipsum viverra, finibus lorem eget, finibus tortor. Curabitur tincidunt magna bibendum vehicula venenatis. Mauris tempus laoreet lacus, vel auctor tellus gravida sit amet. Fusce dictum dolor eu leo tempor, ut hendrerit nisi pellentesque. Vestibulum quis arcu id purus blandit tristique. Suspendisse lobortis porta consequat.\r\n\r\nPellentesque ac tempor ligula. Sed nec faucibus purus. Cras sit amet dolor eget mi condimentum posuere sed in purus. Donec tincidunt et ex quis molestie. Quisque rutrum leo id erat interdum rutrum. Phasellus libero enim, pulvinar et porttitor vitae, ultrices non metus. Donec vitae orci a mauris imperdiet varius sed id ligula. Morbi eget nibh quis odio viverra luctus.\r\n\r\nPhasellus non metus felis. Proin risus massa, hendrerit eu neque eget, auctor ultrices ipsum. Duis viverra et diam ac consequat. Vivamus at rhoncus lacus, ut porttitor arcu. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse non bibendum arcu. Morbi id ligula eget nisl vehicula rutrum. Aliquam aliquam metus tellus, nec ullamcorper lacus lacinia at. Donec aliquet, tortor eu fringilla cursus, ipsum dolor fermentum nunc, eget tempus leo nibh sit amet nisl. Integer porttitor ex ac ullamcorper vehicula.', '1', '0', '0', '1520346134.jpg', '66-450', 'Bogdaniec', '132465798', '0', '9');
INSERT INTO `options` VALUES ('26', '2004', '1', '537000', '0', '19000', '1', 'Francja', '0', '0', '0', '0', '0', '1900', '170', '2', '5', 'Srebrny', '2', '0', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus risus sit amet risus sagittis auctor. Quisque auctor urna id justo elementum molestie. Aliquam accumsan aliquam venenatis. Phasellus in lectus vehicula, pellentesque libero vel, sodales nibh. Praesent quis ligula metus. Maecenas maximus tellus at mauris placerat, ac lobortis nunc viverra. Nam dictum pretium mauris, rhoncus iaculis erat semper eu. Morbi semper ante non leo molestie, vel dignissim tellus iaculis. Vestibulum sit amet condimentum risus, a elementum quam. Suspendisse potenti. Nunc efficitur ante eu elit pulvinar, non molestie nunc mollis. Integer quis consequat nisi, et feugiat mauris. Duis vehicula malesuada metus, vestibulum fermentum augue. Aliquam in rutrum leo. Aenean et lobortis turpis. Ut velit lectus, convallis id condimentum in, lacinia non erat.\r\n\r\nMorbi scelerisque semper sapien sed bibendum. Phasellus imperdiet semper arcu, in tincidunt enim ornare eget. Curabitur vel diam purus. Duis dignissim elementum eros non lacinia. Sed sit amet tempus nunc. Quisque eu felis eget urna auctor rutrum vel quis libero. Duis vitae fermentum ante, vel ultrices nisi. Ut vulputate diam et eros vehicula, in bibendum justo lacinia. Proin ultricies elementum consequat. Proin laoreet sit amet est eget fringilla. Integer vel justo sed leo vehicula dapibus eu vitae magna. Vivamus ultrices euismod enim ut pretium. Nullam faucibus dignissim neque sed fringilla.\r\n\r\nInteger volutpat libero a velit aliquet scelerisque. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris vestibulum justo nec urna mollis rutrum. Vivamus diam arcu, commodo at leo eget, varius tristique lacus. Donec sit amet libero felis. Sed nec sollicitudin lacus, quis mollis lorem. Praesent porttitor suscipit viverra.\r\n\r\nMaecenas posuere dignissim euismod. Cras volutpat lacinia lectus, vitae sagittis neque accumsan id. Sed egestas vel ligula imperdiet tempus. Etiam lectus mi, ultrices et diam in, dignissim facilisis purus. Etiam non consequat magna, vitae tincidunt quam. Donec quis ultricies justo. Nulla congue dolor eu felis fermentum fermentum. Proin eget justo dolor. Suspendisse nec metus rutrum, finibus velit vitae, mattis mi. Curabitur sodales tincidunt tortor quis mollis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec non leo vel arcu posuere sollicitudin.', '0', '0', '1', '1520346435.jpg', '64-700', 'Śmieszkowo', '231564897', '0', '6');
INSERT INTO `options` VALUES ('27', '2015', '2', '23450', '0', '78900', '1', 'Belgia', '0', '1', '1', '1', '0', '3000', '230', '1', '1', 'Czerwony', '3', '0', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec non laoreet odio. Ut molestie justo sit amet commodo accumsan. Donec maximus lacinia commodo. Nulla hendrerit nulla eget magna accumsan, id vehicula mi dapibus. Ut vitae turpis quam. Quisque mattis et lectus id rhoncus. Sed ultricies molestie libero ac mattis. Aliquam urna arcu, pulvinar vitae nisi eget, luctus dictum lectus. Suspendisse potenti. Duis sodales odio sed tortor condimentum, et iaculis est porta. Pellentesque in dapibus risus. Proin tellus nunc, facilisis ac arcu eget, facilisis pulvinar sem.\r\n\r\nSed vitae sagittis ipsum, nec posuere nunc. Aenean neque sem, laoreet vel augue dictum, facilisis tristique ligula. Donec a rhoncus enim. Sed volutpat et est vel efficitur. Proin libero lectus, condimentum a convallis vel, sodales ac est. Phasellus sagittis elementum quam, sed dapibus purus ornare et. Sed consectetur faucibus turpis quis lacinia.\r\n\r\nPraesent eleifend magna magna, non luctus nisl pulvinar sit amet. Nullam interdum, urna at luctus pellentesque, magna enim luctus diam, volutpat ornare leo dolor sit amet justo. Sed convallis imperdiet tortor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pulvinar pretium lectus sed porta. Aliquam condimentum sem dui, a vulputate nisl tristique in. Nunc imperdiet ipsum id neque elementum, vel cursus metus iaculis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.\r\n\r\nIn nec purus lorem. Sed sed euismod nunc. Mauris malesuada sagittis ante sed dapibus. Donec ut massa id est hendrerit venenatis nec ut quam. Nullam non tristique urna. Sed accumsan tempus blandit. Ut convallis nisl gravida nulla fermentum, eu commodo dui consectetur. Morbi finibus blandit lacus, non maximus tellus varius id. Ut vestibulum, nisl ut dignissim laoreet, dolor ligula gravida arcu, quis mollis velit dui sed velit. Vestibulum sit amet lectus massa. Maecenas id ipsum tristique, aliquam justo at, rhoncus nunc. Maecenas lectus tortor, cursus tempor ante eget, consectetur accumsan dui. Curabitur vehicula congue arcu eu ultricies. Nullam scelerisque ipsum nulla, vitae tristique massa tempor eget.', '1', '1', '1', '1520348093.jpg', '32-432', 'Pcim', '312645867', '1', '21');

-- ----------------------------
-- Table structure for `rozmowa`
-- ----------------------------
DROP TABLE IF EXISTS `rozmowa`;
CREATE TABLE `rozmowa` (
  `id_kon` int(5) NOT NULL AUTO_INCREMENT,
  `id_car` int(5) NOT NULL,
  `id_user` int(5) NOT NULL,
  `n_owner` int(1) NOT NULL DEFAULT '0',
  `n_buyer` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kon`),
  KEY `roz-car` (`id_car`),
  KEY `roz-usr` (`id_user`),
  CONSTRAINT `roz-car` FOREIGN KEY (`id_car`) REFERENCES `car` (`id_car`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `roz-usr` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- ----------------------------
-- Records of rozmowa
-- ----------------------------
INSERT INTO `rozmowa` VALUES ('3', '59', '13', '0', '0');
INSERT INTO `rozmowa` VALUES ('4', '59', '12', '1', '0');
INSERT INTO `rozmowa` VALUES ('5', '64', '12', '0', '1');

-- ----------------------------
-- Table structure for `type`
-- ----------------------------
DROP TABLE IF EXISTS `type`;
CREATE TABLE `type` (
  `id_type` int(5) NOT NULL AUTO_INCREMENT,
  `typename` varchar(20) NOT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of type
-- ----------------------------
INSERT INTO `type` VALUES ('1', 'Hatchback');
INSERT INTO `type` VALUES ('2', 'Sedan');
INSERT INTO `type` VALUES ('3', 'Kombi');
INSERT INTO `type` VALUES ('4', 'Van');
INSERT INTO `type` VALUES ('5', 'Pick-up');
INSERT INTO `type` VALUES ('6', 'Cabrio');
INSERT INTO `type` VALUES ('7', 'Coupe');
INSERT INTO `type` VALUES ('8', 'SUV');
INSERT INTO `type` VALUES ('9', 'Off-road');
INSERT INTO `type` VALUES ('10', 'Sport');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id_user` int(5) NOT NULL AUTO_INCREMENT,
  `mail` varchar(30) CHARACTER SET utf8 NOT NULL,
  `password` varchar(150) CHARACTER SET utf8 NOT NULL,
  `salt` varchar(40) CHARACTER SET utf8 NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `city` varchar(30) CHARACTER SET latin2 COLLATE latin2_bin NOT NULL,
  `post` varchar(10) NOT NULL,
  `phone` varchar(10) CHARACTER SET utf8 NOT NULL,
  `special` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin2;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('11', 'test@systemu.eu', 'f4e53748d1356899ea5fecdb5c956b0ed9ae4222', '15441768955a9e99481d49e3.00722860', 'Test', '2018-03-06 14:36:08', 'Pcim', '32-432', '312645867', '0');
INSERT INTO `user` VALUES ('12', 'konto@testowe.pl', 'e322bccbbef7e4535c6c5a8b02712db467c3d2e6', '2284326535a9e9bd18ace85.90217925', 'Test96', '2018-03-06 14:46:57', 'Bogdaniec', '66-450', '132465798', '0');
INSERT INTO `user` VALUES ('13', 'konto2@testowe.pl', 'fe4ccc04401512ad7c039f4db94ae85231aa1f5c', '1772279135a9ea4c43c34b9.80957165', 'Test54', '2018-03-06 15:25:08', 'Śmieszkowo', '64-700', '231564897', '0');
INSERT INTO `user` VALUES ('14', 'konto@admina.com', '60dc5c4349a28ffb1799ab4495d4fa491f032d17', '7975189245a9eac0ee19df3.99625811', 'Admin420', '2018-03-06 15:56:58', 'Przemyśl', '37-700', '606448125', '1');

-- ----------------------------
-- Table structure for `watchlist`
-- ----------------------------
DROP TABLE IF EXISTS `watchlist`;
CREATE TABLE `watchlist` (
  `id_user` int(5) NOT NULL,
  `id_car` int(5) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `f1` (`id_user`),
  KEY `f2` (`id_car`),
  CONSTRAINT `f1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `f2` FOREIGN KEY (`id_car`) REFERENCES `car` (`id_car`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- ----------------------------
-- Records of watchlist
-- ----------------------------
INSERT INTO `watchlist` VALUES ('12', '59', '2018-03-06 14:47:20');
INSERT INTO `watchlist` VALUES ('12', '58', '2018-03-06 14:47:36');
INSERT INTO `watchlist` VALUES ('13', '59', '2018-03-06 15:25:32');
INSERT INTO `watchlist` VALUES ('12', '64', '2018-03-12 10:42:18');

-- ----------------------------
-- Table structure for `wiadomosc`
-- ----------------------------
DROP TABLE IF EXISTS `wiadomosc`;
CREATE TABLE `wiadomosc` (
  `id_wia` int(5) NOT NULL AUTO_INCREMENT,
  `tresc` varchar(280) COLLATE utf8_polish_ci NOT NULL,
  `kto` int(1) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_kon` int(5) NOT NULL,
  PRIMARY KEY (`id_wia`),
  KEY `wia-roz` (`id_kon`),
  CONSTRAINT `wia-roz` FOREIGN KEY (`id_kon`) REFERENCES `rozmowa` (`id_kon`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- ----------------------------
-- Records of wiadomosc
-- ----------------------------
INSERT INTO `wiadomosc` VALUES ('12', 'Testowa wiadomość 001', '1', '2018-03-06 15:31:55', '3');
INSERT INTO `wiadomosc` VALUES ('13', 'Testowa wiadomość 002', '1', '2018-03-06 15:32:24', '4');
INSERT INTO `wiadomosc` VALUES ('14', 'Testowa wiadomość 003', '1', '2018-03-06 15:32:42', '4');
INSERT INTO `wiadomosc` VALUES ('15', 'Testowa odpowiedź 001', '0', '2018-03-10 14:27:01', '4');
INSERT INTO `wiadomosc` VALUES ('16', 'Testowa wiadomość 004', '1', '2018-03-12 10:42:18', '5');
