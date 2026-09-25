<?php

namespace Database\Seeders;

use App\Models\Content;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contents = [
            [
                'type' => 'ayet',
                'body' => 'Kalpler ancak Allah\'ı anmakla huzur bulur.',
                'source' => 'Ra\'d Suresi, 28. ayet',
            ],
            [
                'type' => 'ayet',
                'body' => 'Şüphesiz güçlükle beraber bir kolaylık vardır.',
                'source' => 'İnşirah Suresi, 5. ayet',
            ],
            [
                'type' => 'ayet',
                'body' => 'Eğer şükrederseniz, elbette size nimetimi artırırım.',
                'source' => 'İbrahim Suresi, 7. ayet',
            ],
            [
                'type' => 'ayet',
                'body' => 'Allah sabredenlerle beraberdir.',
                'source' => 'Bakara Suresi, 153. ayet',
            ],
            [
                'type' => 'ayet',
                'body' => 'Allah\'ın rahmetinden ümit kesmeyin.',
                'source' => 'Zümer Suresi, 53. ayet',
            ],
            [
                'type' => 'ayet',
                'body' => 'Kim Allah\'a karşı gelmekten sakınırsa, Allah ona bir çıkış yolu açar.',
                'source' => 'Talak Suresi, 2. ayet',
            ],
            [
                'type' => 'hadis',
                'body' => 'Ameller niyetlere göredir; herkes için niyet ettiği vardır.',
                'source' => 'Buhari, Bedü\'l-Vahy, 1; Müslim, İmare, 155',
            ],
            [
                'type' => 'hadis',
                'body' => 'Sizin en hayırlınız, ahlakı en güzel olanınızdır.',
                'source' => 'Buhari, Edeb, 38',
            ],
            [
                'type' => 'hadis',
                'body' => 'Kolaylaştırınız, zorlaştırmayınız; müjdeleyiniz, nefret ettirmeyiniz.',
                'source' => 'Buhari, İlim, 11; Müslim, Cihad, 6',
            ],
            [
                'type' => 'hadis',
                'body' => 'Müslüman, elinden ve dilinden insanların güvende olduğu kimsedir.',
                'source' => 'Buhari, İman, 4; Müslim, İman, 64',
            ],
            [
                'type' => 'hadis',
                'body' => 'Gülümsemen kardeşinin yüzüne karşı bir sadakadır.',
                'source' => 'Tirmizi, Birr, 36',
            ],
            [
                'type' => 'hadis',
                'body' => 'İnsanların en hayırlısı, insanlara en çok faydalı olandır.',
                'source' => 'Beyhaki, Şuabü\'l-İman, 6/53',
            ],
            [
                'type' => 'soz',
                'body' => 'Dert, insanı yokluğa değil; varlığa ve hakikate çağıran bir davettir.',
                'source' => 'Mevlana Celaleddin Rumi',
            ],
            [
                'type' => 'soz',
                'body' => 'Söz ola kese savaşı, söz ola kestire başı.',
                'source' => 'Yunus Emre',
            ],
            [
                'type' => 'soz',
                'body' => 'Bedenin sağlığı, ruhun huzuru ve aklın berraklığı birbirini tamamlar.',
                'source' => 'İbn-i Sina',
            ],
            [
                'type' => 'soz',
                'body' => 'Dünya, değişimle anlam kazanır; değişime direnen yalnızca kendi dar sınırında kalır.',
                'source' => 'Herakleitos',
            ],
            [
                'type' => 'soz',
                'body' => 'Kendini bilmek, bütün bilgeliğin başlangıcıdır.',
                'source' => 'Sokrates',
            ],
            [
                'type' => 'soz',
                'body' => 'İyi bir hayat, iyi düşünceler ve iyi eylemlerle örülür.',
                'source' => 'Marcus Aurelius',
            ],
            [
                'type' => 'kitap',
                'body' => 'İnsanın anlam arayışını ve en zor şartlarda bile seçme özgürlüğünü anlatan sarsıcı bir hatırat.',
                'source' => 'Viktor E. Frankl - İnsanın Anlam Arayışı',
            ],
            [
                'type' => 'kitap',
                'body' => 'İç dünyayı, vicdanı ve insan ilişkilerinin kırılganlığını derin bir psikolojik bakışla ele alan bir roman.',
                'source' => 'Sabahattin Ali - Kürk Mantolu Madonna',
            ],
            [
                'type' => 'kitap',
                'body' => 'Sade yaşamın, ölçülülüğün ve doğayla uyumun değerini düşündüren klasik bir felsefe metni.',
                'source' => 'Henry David Thoreau - Walden',
            ],
            [
                'type' => 'kitap',
                'body' => 'Adalet, özgürlük ve sorumluluk üzerine her kuşağa yeni sorular bırakan güçlü bir klasik.',
                'source' => 'George Orwell - 1984',
            ],
            [
                'type' => 'kitap',
                'body' => 'İnsanın iyilik, kötülük, seçim ve vicdan meselelerini büyük bir ruh çözümlemesiyle işler.',
                'source' => 'Fyodor Dostoyevski - Suç ve Ceza',
            ],
            [
                'type' => 'kitap',
                'body' => 'Günlük hayatın içindeki küçük ayrıntılara dikkat etmeyi ve içsel dinginliği yeniden keşfetmeyi önerir.',
                'source' => 'Antoine de Saint-Exupery - Küçük Prens',
            ],
            [
                'type' => 'gorev',
                'body' => 'Bugün tanıdığın veya tanımadığın üç kişiye içtenlikle tebessüm et.',
                'source' => null,
            ],
            [
                'type' => 'gorev',
                'body' => 'Ailenden birini ara ve acele etmeden halini hatırını sor.',
                'source' => null,
            ],
            [
                'type' => 'gorev',
                'body' => 'Bugün yaptığın üç güzel şeyi fark edip akşam birkaç cümleyle not al.',
                'source' => null,
            ],
            [
                'type' => 'gorev',
                'body' => 'Sana emeği dokunan birine teşekkürünü açıkça ifade et.',
                'source' => null,
            ],
            [
                'type' => 'gorev',
                'body' => 'Bir yakınının işini kolaylaştıracak küçük bir iyiliği karşılık beklemeden yap.',
                'source' => null,
            ],
            [
                'type' => 'gorev',
                'body' => 'Bugün bir saat boyunca telefonunu sessize al ve çevrendeki dünyayı dikkatle dinle.',
                'source' => null,
            ],
        ];

        foreach ($contents as $content) {
            Content::query()->updateOrCreate(
                [
                    'type' => $content['type'],
                    'body' => $content['body'],
                    'source' => $content['source'],
                ],
                [
                    'is_approved' => true,
                ],
            );
        }
    }
}
