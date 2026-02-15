-- РўР°Р±Р»РёС†Р° РґР»СЏ С…СЂР°РЅРµРЅРёСЏ РЅР°СЃС‚СЂРѕРµРє Telegram Р±РѕС‚Р°
CREATE TABLE IF NOT EXISTS \	elegram_bot\ (
  \id\ int(11) NOT NULL AUTO_INCREMENT,
  \ot_token\ varchar(255) NOT NULL,
  \ot_username\ varchar(100) DEFAULT NULL,
  \webhook_url\ varchar(255) DEFAULT NULL,
  \created_at\ datetime DEFAULT CURRENT_TIMESTAMP,
  \updated_at\ datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (\id\)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- РўР°Р±Р»РёС†Р° РґР»СЏ Р»РѕРіРёСЂРѕРІР°РЅРёСЏ СЃРѕРѕР±С‰РµРЅРёР№ РѕС‚ Telegram
CREATE TABLE IF NOT EXISTS \	elegram_logs\ (
  \id\ int(11) NOT NULL AUTO_INCREMENT,
  \chat_id\ bigint(20) NOT NULL,
  \user_id\ bigint(20) DEFAULT NULL,
  \username\ varchar(100) DEFAULT NULL,
  \irst_name\ varchar(100) DEFAULT NULL,
  \	ext\ text,
  \created_at\ datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (\id\),
  KEY \chat_id\ (\chat_id\),
  KEY \created_at\ (\created_at\)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
