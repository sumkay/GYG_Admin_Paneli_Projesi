# Güvenli ve Zafiyetli PHP Uygulama Karşılaştırması

Bu proje, bir PHP tabanlı web uygulamasının **zafiyetli** ve **güvenli** versiyonlarını karşılaştırmalı olarak sunar. Amaç, OWASP tarafından tanımlanan yaygın güvenlik açıklarını göstermek ve nasıl düzeltilebileceğini öğretmektir.

## 📁 Klasörler

- `zafiyetli/`: Güvenlik önlemleri alınmamış, çeşitli açıklar barındıran sürüm.
- `guvenli/`: Aynı uygulamanın güvenli hale getirilmiş sürümü.

## ⚠️ Zafiyetli Sürümdeki Zafiyetler

- SQL Injection
- Broken Access Control
- XSS
- Zayıf Oturum Yönetimi

## ✅ Güvenli Sürümde Yapılan İyileştirmeler

- Prepared Statements kullanımı
- Rol bazlı erişim kontrolü
- XSS filtrelemesi
- Sağlam oturum kontrolü

## 🛠 Kurulum

1. XAMPP/WAMP gibi bir PHP ortamı kurun.
2. Veritabanını `security_db` adıyla oluşturun ve tabloları ekleyin.
3. `zafiyetli/` veya `guvenli/` klasörünü çalıştırın.

## ⚠️ Uyarı

Zafiyetli sürüm yalnızca eğitim amaçlıdır.

