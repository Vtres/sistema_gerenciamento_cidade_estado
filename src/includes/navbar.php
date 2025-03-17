<!-- navbar -->
<nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
        <a href="<?php echo BASE_URL; ?>"
            class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="<?php echo BASE_URL; ?>public/image/1527807.png"
                class="h-8" alt="Flowbite Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">AdminCidades</span>
        </a>
        <div class="flex items-center space-x-6 rtl:space-x-reverse">
            <a href="https://github.com/Vtres" target="_blank"
                class="text-sm  text-blue-600 dark:text-blue-500 hover:underline">Contato</a>
        </div>
    </div>
</nav>
<nav class="bg-gray-50 dark:bg-gray-700 main-nav">
    <div class="max-w-screen-xl px-4 py-3 mx-auto">
        <div class="flex items-center">
            <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
                <li>
                    <a href="<?php echo BASE_URL; ?>"
                        class=" dark:text-white hover:underline 
                       <?php echo($_SERVER['REQUEST_URI'] == BASE_URL ? 'text-blue-500' : ''); ?>"
                        aria-current="page">Home</a>
                </li>
                <li>
                    <a href="<?php echo BASE_URL; ?>src/view_state.php"
                        class=" dark:text-white hover:underline 
                       <?php echo($_SERVER['REQUEST_URI'] == BASE_URL . 'src/view_state.php' ? 'text-blue-500' : ''); ?>">
                        Estados
                    </a>
                </li>
                <li>
                    <a href="<?php echo BASE_URL; ?>src/view_cities.php"
                        class=" dark:text-white hover:underline 
                       <?php echo($_SERVER['REQUEST_URI'] == BASE_URL . 'src/view_cities.php' ? 'text-blue-500' : ''); ?>">
                        Cidades
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const links = document.querySelectorAll(".main-nav a");

        links.forEach((link) => {
            if (link.href === window.location.href) {
                link.classList.add("text-blue-500");
            }
        });
    });
</script>