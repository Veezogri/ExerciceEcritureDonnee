<?php // footer.php ?>
  </main>
  <footer class="bg-gray-800 text-white py-10 mt-16 animate-fade-in">
    <div class="max-w-6xl mx-auto px-6">
      <div class="flex flex-col md:flex-row justify-between items-center">
        <div class="mb-4 md:mb-0 text-center md:text-left">
          <p class="text-sm">&copy; <?= date('Y') ?> - Hôpital Saint Gilles</p>
          <p class="text-sm">CRM développé avec ❤️ par <strong>Fares RIAL</strong></p>
        </div>

        <div class="flex space-x-6">
          <a href="https://www.linkedin.com/in/fares-rial-4064471b3/" title="LinkedIn" target="_blank" class="group relative inline-flex items-center justify-center overflow-hidden text-white rounded-full w-10 h-10 bg-gray-700 hover:bg-gradient-to-r hover:from-blue-600 hover:to-blue-400 transition">
            <i class="fab fa-linkedin transition duration-300 group-hover:scale-110"></i>
          </a>
          <a href="https://github.com/Veezogri" title="GitHub" target="_blank" class="group relative inline-flex items-center justify-center overflow-hidden text-white rounded-full w-10 h-10 bg-gray-700 hover:bg-gradient-to-r hover:from-gray-600 hover:to-gray-400 transition">
            <i class="fab fa-github transition duration-300 group-hover:scale-110"></i>
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
