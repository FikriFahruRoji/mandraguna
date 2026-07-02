<template>
  <Head :title="t('Keberlanjutan', 'Sustainability', 'サステナビリティ')" />
  <PublicLayout>
    <!-- Hero Section -->
    <section class="page-hero">
      <div class="container split-grid">
        <div class="split-content">
          <span class="label-caps" style="color: var(--color-primary-fixed-dim); margin-bottom: 12px; display: block;">{{ t('EKONOMI SIRKULAR', 'CIRCULAR ECONOMY', '循環型経済') }}</span>
          <h1 class="headline-xl" style="color: white; margin-top: 8px;">Waste to Wealth</h1>
          <p class="body-lg" style="color: rgba(255,255,255,0.8); margin-top: 20px; line-height: 28px;">
            {{ t('Mengubah limbah penyamakan kulit sapi—baik limbah cair kapur maupun padat—menjadi pupuk organik bermutu tinggi. Kami menutup siklus produksi untuk memulihkan kesehatan tanah dan mengurangi dampak negatif terhadap lingkungan.', 'Transforming cow leather tanning waste—both lime wastewater and solid waste—into high-quality organic fertilizer. We close the production cycle to restore soil health and reduce negative environmental impacts.', '石灰廃水および固体廃棄物の両方の牛革鞣し廃棄物を高品質の有機肥料に変換します。生産サイクルを閉じて土壌の健康を回復し、環境への悪影響を減らします。') }}
          </p>
        </div>
        <div class="split-visual" style="position: relative;">
          <div class="image-box" style="height: 400px; border-radius: var(--rounded-lg); border: 1px solid rgba(255,255,255,0.1); overflow: hidden; background: rgba(255,255,255,0.05); display: flex; align-items: center; justify-content: center; font-size: 64px;">
            <img v-if="sustainability.sustainability_hero_image" :src="'/storage/' + sustainability.sustainability_hero_image" alt="" style="width: 100%; height: 100%; object-fit: cover;" />
            <span v-else>♻️</span>
          </div>
          <div class="zero-waste-tag" style="position: absolute; bottom: 16px; left: 16px; background: white; padding: 12px 20px; border-radius: var(--rounded); display: flex; align-items: center; gap: 10px; border: 1px solid var(--color-border); box-shadow: var(--shadow-card); color: var(--color-earth-black);">
            <span style="color: var(--color-success); font-size: 20px;">🌱</span>
            <span class="label-caps" style="font-size: 11px;">{{ t('Inisiatif Zero Waste', 'Zero Waste Initiative', 'ゼロ・ウェイスト・イニシアティブ') }}</span>
          </div>
        </div>
      </div>
    </section>

    <!-- Processing Blueprint Section -->
    <section class="section" style="background: var(--color-surface-container-low);">
      <div class="container">
        <div style="text-align: center; max-width: 600px; margin: 0 auto 60px;">
          <span class="label-caps" style="color: var(--color-primary); display: block; margin-bottom: 8px;">{{ t('ALUR PROSES KAMI', 'OUR PROCESS WORKFLOW', '私たちのプロセスフロー') }}</span>
          <h2 class="headline-lg">{{ t('Cetak Biru Pengolahan', 'Processing Blueprint', '処理の設計図') }}</h2>
          <p class="body-md" style="color: var(--color-secondary); margin-top: 12px;">{{ t('Dari pengumpulan limbah mentah hingga menjadi nutrisi organik murni siap pakai.', 'From raw waste collection to ready-to-use pure organic nutrients.', '生廃棄物の収集から、すぐに使用できる純粋な有機栄養素まで。') }}</p>
        </div>

        <div class="blueprint-grid">
          <!-- Step 1 -->
          <div class="blueprint-card card">
            <span style="font-size: 32px; display: block; margin-bottom: 20px;">🧹</span>
            <h3 class="headline-md" style="font-size: 20px; margin-bottom: 8px;">{{ t('1. Pengumpulan (Collection)', '1. Collection', '1. 収集') }}</h3>
            <p class="body-md" style="color: var(--color-secondary); line-height: 24px;">{{ t('Pemulihan sistematis limbah kapur dan sisa potongan kulit padat dari industri penyamakan kulit lokal, mencegah penumpukan di TPA.', 'Systematic recovery of lime waste and solid leather scraps from local tanneries, preventing landfill accumulation.', '地元の製革所からの石灰廃棄物や固体の革くずの体系的な回収により、埋め立て地への蓄積を防ぎます。') }}</p>
          </div>

          <!-- Step 2 -->
          <div class="blueprint-card card">
            <span style="font-size: 32px; display: block; margin-bottom: 20px;">🔬</span>
            <h3 class="headline-md" style="font-size: 20px; margin-bottom: 8px;">{{ t('2. Pemurnian (Refinement)', '2. Refinement', '2. 精製') }}</h3>
            <p class="body-md" style="color: var(--color-secondary); line-height: 24px;">{{ t('Pemrosesan biologis dan mekanis tingkat lanjut untuk menetralisir senyawa berbahaya sekaligus menjaga keutuhan bahan organik esensial.', 'Advanced biological and mechanical processing to neutralize harmful compounds while preserving essential organic materials.', '必須の有機素材を保護しながら有害な化合物を中和するための、高度な生物学的および機械的処理。') }}</p>
          </div>

          <!-- Step 3 -->
          <div class="blueprint-card card">
            <span style="font-size: 32px; display: block; margin-bottom: 20px;">📦</span>
            <h3 class="headline-md" style="font-size: 20px; margin-bottom: 8px;">{{ t('3. Formulasi (Formulation)', '3. Formulation', '3. 配合') }}</h3>
            <p class="body-md" style="color: var(--color-secondary); line-height: 24px;">{{ t('Pencampuran akhir menjadi pupuk organik premium yang kaya akan kandungan nitrogen organik dan karbon organik, siap diaplikasikan pada lahan pertanian.', 'Final blending into premium organic fertilizer rich in organic nitrogen and organic carbon, ready for agricultural application.', '有機窒素と有機炭素が豊富なプレミアム有機肥料への最終ブレンド、農地への散布準備完了。') }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Environmental Impact Data Section -->
    <section class="section bg-white">
      <div class="container split-grid">
        <div class="split-visual">
          <div class="image-box" style="height: 400px; border-radius: var(--rounded-lg); border: 1px solid var(--color-border); overflow: hidden; background: var(--color-surface-container); display: flex; align-items: center; justify-content: center; font-size: 64px;">
            <img v-if="sustainability.sustainability_impact_image" :src="'/storage/' + sustainability.sustainability_impact_image" alt="" style="width: 100%; height: 100%; object-fit: cover;" />
            <span v-else>📊</span>
          </div>
        </div>

        <div class="split-content" style="display: flex; flex-direction: column; justify-content: center;">
          <span class="label-caps" style="color: var(--color-primary); display: block; margin-bottom: 8px;">{{ t('DAMPAK NYATA', 'REAL IMPACT', 'リアルな影響') }}</span>
          <h2 class="headline-lg">{{ t('Dampak yang Terukur', 'Measurable Impact', '測定可能な影響') }}</h2>
          <p class="body-md" style="color: var(--color-secondary); margin-top: 16px; margin-bottom: 32px; line-height: 26px;">
            {{ t('Pendekatan ekonomi sirkular kami memberikan manfaat nyata yang terukur bagi kelestarian lingkungan dan keberlanjutan sektor tani.', 'Our circular economy approach delivers tangible, measurable benefits for environmental sustainability and the farming sector.', '私たちの循環経済アプローチは、環境の持続可能性と農業部門に具体的で測定可能な利益をもたらします。') }}
          </p>

          <div class="impact-table" style="border: 1px solid var(--color-border); border-radius: var(--rounded-lg); overflow: hidden;">
            <div class="impact-row">
              <span class="label-caps" style="color: var(--color-on-surface);">{{ t('Pengurangan Limpasan Kimia', 'Chemical Runoff Reduction', '化学流出の削減') }}</span>
              <span class="impact-val">85%</span>
            </div>
            <div class="impact-row">
              <span class="label-caps" style="color: var(--color-on-surface);">{{ t('Tingkat Pemulihan Kesehatan Tanah', 'Soil Health Recovery Rate', '土壌健康回復率') }}</span>
              <span class="impact-val">{{ t('3x Lipat', '3x Fold', '3倍') }}</span>
            </div>
            <div class="impact-row">
              <span class="label-caps" style="color: var(--color-on-surface);">{{ t('Limbah yang Dialihkan dari TPA', 'Waste Diverted from Landfill', '埋め立て地から回避された廃棄物') }}</span>
              <span class="impact-val">10K+ {{ t('Ton', 'Tons', 'トン') }}</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Dynamic Sustainability Metrics Section (Retrieved from Settings) -->
    <section class="section" style="background: var(--color-surface-container-low); border-top: 1px solid var(--color-border);">
      <div class="container">
        <div style="text-align: center; max-width: 600px; margin: 0 auto 60px;">
          <span class="label-caps" style="color: var(--color-primary); display: block; margin-bottom: 8px;">{{ t('STATISTIK KONTRIBUSI', 'CONTRIBUTION STATISTICS', '貢献統計') }}</span>
          <h2 class="headline-lg">{{ t('Keberlanjutan Mandraguna', 'Mandraguna Sustainability', 'マンドラグナの持続可能性') }}</h2>
          <p class="body-md" style="color: var(--color-secondary); margin-top: 12px;">{{ t('Akumulasi data riil kontribusi ekologis yang berhasil dikelola melalui panel admin kami.', 'Accumulation of real ecological contribution data managed through our admin panel.', '管理パネルを通じて管理された、実際の環境貢献データの累積。') }}</p>
        </div>

        <div class="metrics-grid">
          <div class="metric-card card">
            <span class="metric-icon">♻️</span>
            <span class="metric-num">{{ sustainability.sustainability_waste_processed || '500' }} {{ t('Ton', 'Tons', 'トン') }}</span>
            <span class="metric-label">{{ t('Limbah Kulit Diolah', 'Leather Waste Processed', '処理された革廃棄物') }}</span>
          </div>
          <div class="metric-card card">
            <span class="metric-icon">📉</span>
            <span class="metric-num">{{ sustainability.sustainability_co2_reduced || '120' }} {{ t('Ton', 'Tons', 'トン') }}</span>
            <span class="metric-label">{{ t('Pengurangan Emisi CO₂', 'CO₂ Emissions Reduction', 'CO₂排出削減量') }}</span>
          </div>
          <div class="metric-card card">
            <span class="metric-icon">👨‍🌾</span>
            <span class="metric-num">{{ sustainability.sustainability_farmers_served || '1,200' }}</span>
            <span class="metric-label">{{ t('Petani Bermitra', 'Partnering Farmers', '提携農家数') }}</span>
          </div>
          <div class="metric-card card">
            <span class="metric-icon">🗺️</span>
            <span class="metric-num">{{ sustainability.sustainability_hectares_covered || '3,500' }} Ha</span>
            <span class="metric-label">{{ t('Luas Lahan Tercakup', 'Land Area Covered', '対象農地面積') }}</span>
          </div>
        </div>
      </div>
    </section>

    <!-- Biodiversity Section -->
    <section class="section bg-white" style="border-top: 1px solid var(--color-border);">
      <div class="container text-center" style="max-width: 800px;">
        <div class="image-box" style="height: 320px; border-radius: var(--rounded-lg); border: 1px solid var(--color-border); overflow: hidden; background: var(--color-surface-container); display: flex; align-items: center; justify-content: center; font-size: 64px; margin-bottom: 40px;">
          <img v-if="sustainability.sustainability_biodiversity_image" :src="'/storage/' + sustainability.sustainability_biodiversity_image" alt="" style="width: 100%; height: 100%; object-fit: cover;" />
          <span v-else>🦋</span>
        </div>
        <span class="label-caps" style="color: var(--color-primary); display: block; margin-bottom: 8px;">{{ t('MENJAGA EKOSISTEM', 'PRESERVING THE ECOSYSTEM', '生態系の保護') }}</span>
        <h2 class="headline-lg">{{ t('Mendukung Keanekaragaman Hayati', 'Supporting Biodiversity', '生物多様性のサポート') }}</h2>
        <p class="body-lg" style="color: var(--color-secondary); margin-top: 20px; line-height: 30px;">
          {{ t('Dengan mengganti pupuk kimia sintetis dengan alternatif organik berbasis pemanfaatan sisa bahan alami, kita aktif meminimalkan tingkat racun di dalam tanah. Hal ini memungkinkan mikroflora dan fauna tanah alami berkembang biak kembali, membangun ekosistem pertanian yang sehat dan tangguh demi masa depan generasi mendatang.', 'By replacing synthetic chemical fertilizers with organic alternatives based on natural resources, we actively minimize toxic levels in the soil. This allows natural soil microflora and fauna to thrive again, building a healthy and resilient agricultural ecosystem for future generations.', '合成化学肥料を天然資源ベースの有機代替品に置き換えることにより、土壌中の毒性レベルを積極的に最小限に抑えます。これにより、自然な土壌微生物相と動物相が再び繁栄し、将来の世代のために健康的で回復力のある農業生態系を構築できます。') }}
        </p>
      </div>
    </section>
  </PublicLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import { useLanguage } from '@/composables/useLanguage';

defineProps({
    sustainability: Object,
    settings: Object
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

.blueprint-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 32px;
}

.blueprint-card {
    transition: transform var(--transition-base);
}

.blueprint-card:hover {
    transform: translateY(-4px);
}

.impact-table {
    width: 100%;
}

.impact-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 24px;
    border-bottom: 1px solid var(--color-border);
}

.impact-row:nth-child(even) {
    background-color: var(--color-background);
}

.impact-row:last-child {
    border-bottom: none;
}

.impact-val {
    font-family: var(--font-headline);
    font-size: 24px;
    font-weight: 700;
    color: var(--color-primary);
}

/* Metrics Grid */
.metrics-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
}

.metric-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 32px 24px;
    background: var(--color-surface-white);
    border: 1px solid var(--color-border);
    border-radius: var(--rounded-lg);
    transition: transform var(--transition-base), box-shadow var(--transition-base);
}

.metric-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-soft);
}

.metric-icon {
    font-size: 32px;
    margin-bottom: 16px;
}

.metric-num {
    font-family: var(--font-headline);
    font-size: 28px;
    font-weight: 800;
    color: var(--color-primary);
    margin-bottom: 8px;
}

.metric-label {
    font-family: var(--font-label);
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    color: var(--color-secondary);
}

@media (max-width: 1024px) {
    .split-grid, .blueprint-grid, .metrics-grid {
        grid-template-columns: 1fr !important;
        gap: 32px;
    }
}
</style>
