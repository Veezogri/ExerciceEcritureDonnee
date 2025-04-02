<?php // footer.php ?>
  </main>
  <footer class="bg-gray-800 text-white py-10 mt-16 animate-fade-in">
    <div class="max-w-6xl mx-auto px-6">
      <div class="flex flex-col md:flex-row justify-between items-center">
        <div class="mb-4 md:mb-0 text-center md:text-left">
          <p class="text-sm">&copy; <?= date('Y') ?> - Hôpital Saint Gilles</p>
          <p class="text-sm">CRM développé avec ❤️ par <strong>Fares RIAL</strong></p>
        </div>

        <div class="flex space-x-6 text-2xl">
          <a href="https://www.linkedin.com/in/fares-rial-4064471b3/" title="LinkedIn" class="hover:text-gray-300 transition">
            <i class="fab fa-linkedin"></i>
          </a>
          <a href="https://github.com/Veezogri" target="_blank" title="GitHub" class="hover:text-gray-300 transition">
            <i class="fab fa-github"></i>
          </a>
        </div>
      </div>
    </div>
  </footer>

  <style>
    @keyframes fade-in {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
      animation: fade-in 0.8s ease-out both;
    }
  </style>
</body>
</html>