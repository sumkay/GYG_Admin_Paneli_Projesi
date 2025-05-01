# Güvenli ve Güvensiz PHP Uygulama Karşılaştırması

Bu proje, bir PHP tabanlı web uygulamasının **güvensiz** ve **güvenli** versiyonlarını karşılaştırmalı olarak sunar. Amaç, OWASP tarafından tanımlanan yaygın güvenlik açıklarını göstermek ve nasıl düzeltilebileceğini öğretmektir.

## 📁 Klasörler

- `guvensiz/`: Güvenlik önlemleri alınmamış, çeşitli açıklar barındıran sürüm.
- `guvenli/`: Aynı uygulamanın güvenli hale getirilmiş sürümü.

## ⚠️ Güvensiz Sürümdeki Zafiyetler

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
3. `guvensiz/` veya `guvenli/` klasörünü çalıştırın.

## ⚠️ Uyarı

Güvensiz sürüm yalnızca eğitim amaçlıdır.

