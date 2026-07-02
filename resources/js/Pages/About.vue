<template>
  <Head :title="t('Tentang Kami', 'About Us', '私たちについて')" />
  <PublicLayout>
    <!-- Hero Section -->
    <section class="page-hero">
      <div class="container">
        <span class="label-caps" style="color: var(--color-primary-container); margin-bottom: 8px; display: block;">{{ t('SEJARAH KAMI', 'OUR HISTORY', '私たちの歴史') }}</span>
        <h1 class="headline-xl" style="color: white; margin-top: 8px;">{{ t('Menumbuhkan Kehidupan dari Warisan Industri', 'Nurturing Life from Industrial Heritage', '産業遺産から生命を育む') }}</h1>
        <p class="body-lg" style="color: rgba(255,255,255,0.8); margin-top: 20px; max-width: 600px;">
          {{ t('Mandraguna didirikan atas satu landasan kuat: bahwa limbah dari satu industri dapat menjadi sumber kehidupan bagi industri lainnya. Kami hadir untuk menutup siklus antara produk sampingan industri and vitalitas pertanian.', 'Mandraguna was founded on one strong foundation: that waste from one industry can become the lifeblood of another. We exist to close the loop between industrial byproducts and agricultural vitality.', 'マンドラグナは、「ある産業の廃棄物が別の産業の生命線になり得る」という強力な基盤の上に設立されました。私たちは、産業副産物と農業の活力の間のループを閉じるために存在しています。') }}
        </p>
      </div>
    </section>

    <!-- Side Image box -->
    <section class="section bg-white">
      <div class="container split-grid">
        <div class="split-content">
          <span class="label-caps" style="color: var(--color-primary);">{{ t('AWAL MULA', 'THE BEGINNING', '始まり') }}</span>
          <h2 class="headline-lg" style="margin-top: 12px;">{{ t('Menutup Siklus Lingkungan', 'Closing the Environmental Cycle', '環境サイクルの完結') }}</h2>
          <p class="body-md" style="margin-top: 16px; color: var(--color-on-surface-variant); line-height: 26px;">
            {{ t('Kami percaya pada sistem sirkular di mana limbah ditiadakan, tanah diperkaya, dan hasil panen dioptimalkan. Dengan mengubah produk sampingan industri menjadi input yang memberi kehidupan, kami menciptakan masa depan yang berkelanjutan bagi pertanian Indonesia.', 'We believe in a circular system where waste is eliminated, soil is enriched, and crop yields are optimized. By transforming industrial byproducts into life-giving inputs, we create a sustainable future for Indonesian agriculture.', '私たちは、廃棄物が排除され、土壌が豊かになり、作物の収量が最適化される循環システムを信じています。産業副産物を生命を与えるインプットに変えることで、インドネシア農業の持続可能な未来を創造します。') }}
          </p>
        </div>
        <div class="split-visual">
          <div class="image-box" style="height: 400px; border-radius: var(--rounded-lg); border: 1px solid var(--color-border); overflow: hidden; background: var(--color-surface-container); display: flex; align-items: center; justify-content: center; font-size: 64px;">
            <img v-if="about_page.about_beginning_image" :src="'/storage/' + about_page.about_beginning_image" alt="" style="width: 100%; height: 100%; object-fit: cover;" />
            <span v-else>🌱</span>
          </div>
        </div>
      </div>
    </section>

    <!-- The Crisis Section -->
    <section class="section" style="background: var(--color-surface-container-low);">
      <div class="container split-grid reverse">
        <div class="split-visual">
          <div class="image-box" style="height: 400px; border-radius: var(--rounded-lg); border: 1px solid var(--color-border); overflow: hidden; background: var(--color-surface-container); display: flex; align-items: center; justify-content: center; font-size: 64px;">
            <img v-if="about_page.about_crisis_image" :src="'/storage/' + about_page.about_crisis_image" alt="" style="width: 100%; height: 100%; object-fit: cover; filter: grayscale(1);" />
            <span v-else style="filter: grayscale(1);">🌊</span>
          </div>
        </div>
        <div class="split-content">
          <div style="display: flex; align-items: center; gap: 8px; color: var(--color-error); margin-bottom: 12px;">
            <span>💧</span>
            <span class="label-caps">{{ t('KRISIS LINGKUNGAN', 'ENVIRONMENTAL CRISIS', '環境危機') }}</span>
          </div>
          <h2 class="headline-lg">{{ t('Dampak dari Aktivitas Industri', 'The Impact of Industrial Activity', '産業活動の影響') }}</h2>
          <p class="body-md" style="margin-top: 16px; color: var(--color-on-surface-variant); line-height: 26px;">
            {{ t('Selama beberapa dekade, industri penyamakan kulit sapi menghasilkan limbah biologis yang signifikan dan seringkali berakhir di aliran air penting. Produk sampingan kaya nitrogen ini, jika tidak diolah, bertindak sebagai polutan parah yang merusak ekosistem lokal dan mencemari sumber air bersih.', 'For decades, the beef tannery industry has generated significant biological waste that often ends up in critical waterways. This nitrogen-rich byproduct, if left untreated, acts as a severe pollutant, disrupting local ecosystems and contaminating clean water sources.', '何十年もの間、牛革鞣し産業は、重要な河川や水路に流出することが多い深刻な生物学的廃棄物を排出してきました。この窒素豊富な副産物は、処理されずに放置されると、深刻な汚染物質として作用し、地元の生態系を破壊し、きれいな水源を汚染します。') }}
          </p>
        </div>
      </div>
    </section>

    <!-- The Innovation Section -->
    <section class="section bg-white">
      <div class="container">
        <div style="text-align: center; max-width: 720px; margin: 0 auto 60px;">
          <span class="label-caps" style="color: var(--color-primary); display: block; margin-bottom: 8px;">{{ t('INOVASI KAMI', 'OUR INNOVATION', '私たちのイノベーション') }}</span>
          <h2 class="headline-lg">{{ t('Mengubah Limbah Menjadi Berkah', 'Turning Waste Into Blessing', '廃棄物を恵みに変える') }}</h2>
          <p class="body-md" style="color: var(--color-secondary); margin-top: 16px; line-height: 26px;">
            {{ t('Melalui proses hidrolisis canggih, kami mengekstrak asam amino bernilai tinggi dari limbah penyamakan kulit sapi, menetralisir ancaman lingkungan tersebut sekaligus mengubahnya menjadi pupuk organik premium.', 'Through advanced hydrolysis, we extract high-value amino acids from cattle tannery waste, neutralizing this environmental threat while converting it into premium organic fertilizer.', '高度な加水分解技術を通じて、牛革鞣し廃棄物から高価値のアミノ酸を抽出し、環境への脅威を無害化すると同時に、プレミアム有機肥料へと変換します。') }}
          </p>
        </div>

        <div class="split-grid">
          <div class="split-visual" style="height: 400px; border-radius: var(--rounded-lg); border: 1px solid var(--color-border); overflow: hidden; background: var(--color-surface-container); display: flex; align-items: center; justify-content: center; font-size: 64px;">
            <img v-if="about_page.about_innovation_image" :src="'/storage/' + about_page.about_innovation_image" alt="" style="width: 100%; height: 100%; object-fit: cover;" />
            <span v-else>🔬</span>
          </div>
          <div style="display: flex; flex-direction: column; justify-content: center; gap: 24px;">
            <div class="card" style="padding: 24px; border: 1px solid var(--color-border); border-radius: var(--rounded-md);">
              <h3 class="headline-md" style="font-size: 20px; display: flex; align-items: center; gap: 12px; margin-bottom: 8px;"><span style="color: var(--color-primary);">🧪</span> {{ t('Ekstraksi Canggih', 'Advanced Extraction', '高度な抽出') }}</h3>
              <p class="body-md" style="color: var(--color-secondary);">{{ t('Proses paten kami secara aman mengisolasi nitrogen bio-tersedia dan kompleks asam amino dari limbah mentah.', 'Our patented process safely isolates bio-available nitrogen and amino acid complexes from raw waste.', '当社の特許取得プロセスは、生廃棄物からバイオ利用可能な窒素とアミノ酸複合体を安全に分離します。') }}</p>
            </div>
            <div class="card" style="padding: 24px; border: 1px solid var(--color-border); border-radius: var(--rounded-md);">
              <h3 class="headline-md" style="font-size: 20px; display: flex; align-items: center; gap: 12px; margin-bottom: 8px;"><span style="color: var(--color-primary);">🌱</span> {{ t('Restorasi Tanah', 'Soil Restoration', '土壌回復') }}</h3>
              <p class="body-md" style="color: var(--color-secondary);">{{ t('Senyawa yang dihasilkan secara signifikan meningkatkan kesehatan mikrobioma tanah dan meningkatkan ketahanan tanaman secara alami.', 'The resulting compounds significantly boost soil microbiome health and naturally enhance crop resilience.', '生成された化合物は、土壌微生物相の健康を大幅に高め、作物の回復力を自然に高めます。') }}</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Mission & Vision Section -->
    <section class="section" style="background: var(--color-earth-black); color: white;">
      <div class="container grid-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 32px;">
        <div style="border: 1px solid rgba(255,255,255,0.15); padding: 48px; border-radius: var(--rounded-lg); background: rgba(255,255,255,0.02);">
          <div style="display: flex; align-items: center; gap: 8px; color: var(--color-primary-container); margin-bottom: 24px;">
            <span>🚩</span>
            <span class="label-caps">{{ t('MISI', 'MISSION', 'ミッション') }}</span>
          </div>
          <h3 class="headline-md" style="color: white; margin-bottom: 16px;">{{ t('Meminimalkan dampak negatif industri melalui inovasi pertanian.', 'Minimizing the negative impact of industry through agricultural innovation.', '農業イノベーションを通じて、産業による悪影響を最小限に抑えます。') }}</h3>
          <p class="body-md" style="color: rgba(255,255,255,0.7); line-height: 26px;">{{ t('Kami berupaya keras menyediakan solusi organik berkinerja tinggi yang terukur guna memulihkan kesehatan tanah sekaligus aktif memecahkan krisis limbah industri.', 'We strive to provide scalable, high-performance organic solutions to restore soil health while actively solving the industrial waste crisis.', '私たちは、産業廃棄物問題を積極的に解決しながら、土壌の健康を回復させるための拡張可能で高性能な有機ソリューションの提供に努めています。') }}</p>
        </div>
        <div style="border: 1px solid rgba(255,255,255,0.15); padding: 48px; border-radius: var(--rounded-lg); background: rgba(255,255,255,0.02);">
          <div style="display: flex; align-items: center; gap: 8px; color: var(--color-primary-container); margin-bottom: 24px;">
            <span>👁️</span>
            <span class="label-caps">{{ t('VISI', 'VISION', 'ビジョン') }}</span>
          </div>
          <h3 class="headline-md" style="color: white; margin-bottom: 16px;">{{ t('Masa depan bersiklus tertutup untuk pertanian global.', 'A closed-loop future for global agriculture.', 'グローバル農業のクローズドループ（循環型）な未来。') }}</h3>
          <p class="body-md" style="color: rgba(255,255,255,0.7); line-height: 26px;">{{ t('Menjadi standar institusional untuk nutrisi tanaman berkelanjutan, membuktikan tanggung jawab ekologis dan hasil panen premium saling berkaitan erat.', 'To become the institutional standard for sustainable crop nutrition, proving that ecological responsibility and premium yields are intrinsically linked.', '環境責任とプレミアムな作物の収量が本質的に結びついていることを証明し、持続可能な作物栄養の制度的基準となること。') }}</p>
        </div>
      </div>
    </section>

    <!-- Leadership/Impact Section -->
    <section class="section bg-white">
      <div class="container split-grid">
        <div class="split-content" style="display: flex; flex-direction: column; justify-content: center;">
          <h2 class="headline-lg">{{ t('Stabilitas Institusi. Hasil Terbukti.', 'Institutional Stability. Proven Results.', '制度的安定性。実証された実績。') }}</h2>
          <p class="body-md" style="margin-top: 16px; color: var(--color-secondary); line-height: 26px;">
            {{ t('Didukung oleh pemangku kepentingan lingkungan terkemuka dan pakar pertanian, Mandraguna memberikan konsistensi dalam skala besar bagi mitra pertanian industri.', 'Backed by leading environmental stakeholders and agricultural experts, Mandraguna delivers consistency at scale for industrial agriculture partners.', '主要な環境関係者や農業専門家に支えられ、マンドラグナは産業農業パートナーに大規模な一貫性を提供します。') }}
          </p>
          <div style="margin-top: 32px;">
            <Link href="/sustainability" class="btn btn-ghost" style="text-transform: uppercase;">{{ t('Lihat Data Teknis', 'View Technical Data', '技術データを見る') }}</Link>
          </div>
        </div>
        <div class="split-visual">
          <div class="image-box" style="height: 400px; border-radius: var(--rounded-lg); border: 1px solid var(--color-border); overflow: hidden; background: var(--color-surface-container); display: flex; align-items: center; justify-content: center; font-size: 64px;">
            <img v-if="about_page.about_leadership_image" :src="'/storage/' + about_page.about_leadership_image" alt="" style="width: 100%; height: 100%; object-fit: cover;" />
            <span v-else>📈</span>
          </div>
        </div>
      </div>
    </section>
  </PublicLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import { useLanguage } from '@/composables/useLanguage';

defineProps({
    about_page: { type: Object, default: () => ({}) }
});

const { t } = useLanguage();
</script>

<style scoped>
.page-hero {
    padding: 160px 0 80px;
    background: linear-gradient(135deg, var(--color-earth-black) 0%, #2a2000 100%);
}

.section {
    padding: var(--space-section) 0;
}

.split-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 64px;
    align-items: center;
}

@media (max-width: 1024px) {
    .split-grid, .container.grid-2 {
        grid-template-columns: 1fr !important;
        gap: 32px;
    }
    .split-grid.reverse .split-content {
        order: 2;
    }
    .split-grid.reverse .split-visual {
        order: 1;
    }
}
</style>
