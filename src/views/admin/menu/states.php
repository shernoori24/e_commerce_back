<!-- Contenu dynamique ici -->

<div id="stats">
  <div class="flex flex-col gap-6 p-4">
    <!-- Section 1 : Deux div en ligne -->
    <div class="flex flex-col gap-4 md:flex-row">
      <h2 class="text-2xl font-bold md:hidden">Deux div en ligne</h2>
      <div class="flex-1 bg-blue-100 text-sky-700 p-4 min-h-[150px]">
        <h2 class="hidden text-2xl font-bold md:block">Trafic d'utilisateurs</h2>
        <canvas id="userTrafficChart"></canvas>
      </div>
      <div class="flex-1 bg-green-100 text-green-700 p-4 min-h-[150px]">
        <h2 class="hidden text-2xl font-bold md:block">Nombre de commandes par jour</h2>
        <canvas id="orderCountChart"></canvas>
      </div>
    </div>
    <!-- Un div en pleine largeur -->
    <div class="w-full bg-pink-100 text-pink-700 p-4 min-h-[150px]">
      <h2 class="text-2xl font-bold">category Orders </h2>
      <canvas id="categoryOrdersChart"></canvas>
    </div>

    <!-- Section 2 : Trois div en colonne -->
    <div class="flex flex-col gap-4 md:flex-row">
      <h2 class="text-2xl font-bold md:hidden">Trois div en colonne</h2>

      <div class="flex-1 bg-red-100 text-red-700 p-4 min-h-[150px]">
        <h2 class="hidden text-2xl font-bold md:block">Revenue par Jour</h2>
        <canvas id="dailyRevenueChart"></canvas>
      </div>
      <div class="flex-1 bg-yellow-100 text-yellow-700 p-4 min-h-[150px]">
        <h2 class="hidden text-2xl font-bold md:block">Revenue par Semaine </h2>
        <canvas id="weeklyRevenueChart"></canvas>
      </div>
      <div class="flex-1 bg-purple-100 text-purple-700 p-4 min-h-[150px]">
        <h2 class="hidden text-2xl font-bold md:block">Revenue par Mois</h2>
        <canvas id="monthlyRevenueChart"></canvas>
      </div>
    </div>
  </div>
</div>