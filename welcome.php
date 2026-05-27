<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEBMOL | PHP Web Application Framework</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .animate-float { animation: float 3s ease-in-out infinite; }
        
        .gradient-text {
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 font-sans selection:bg-blue-100">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
            <div class="text-2xl font-bold tracking-tighter">
                <span class="text-blue-600">WEB</span>MOL
            </div>
            <div class="hidden md:flex space-x-8 text-sm font-medium text-slate-600">
                <a href="#" class="hover:text-blue-600 transition">Documentation</a>
                <a href="#" class="hover:text-blue-600 transition">Ecosystem</a>
                <a href="#" class="hover:text-blue-600 transition">Showcase</a>
            </div>
            <a href="#" class="bg-slate-900 text-white px-5 py-2 rounded-full text-sm font-medium hover:bg-slate-800 transition shadow-lg shadow-blue-900/10">
                Get Started
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center max-w-4xl mx-auto" 
                 x-data="{ shown: false }" 
                 x-init="setTimeout(() => shown = true, 100)">
                
                <h1 class="text-5xl lg:text-7xl font-extrabold tracking-tight mb-6 transition-all duration-1000 transform"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                    The PHP Framework for <br>
                    <span class="gradient-text">High-End Applications</span>
                </h1>
                
                <p class="text-lg lg:text-xl text-slate-600 mb-10 leading-relaxed transition-all duration-1000 delay-300 transform"
                   :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                    WEBMOL provides the architectural elegance and speed needed to build 
                    robust enterprise solutions without the traditional overhead.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 transition-all duration-1000 delay-500 transform"
                     :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                    <code class="bg-slate-900 text-blue-400 px-6 py-3 rounded-xl font-mono text-sm shadow-2xl">
                        composer create-project webmol/app
                    </code>
                    <button class="w-full sm:w-auto px-8 py-3 bg-white border border-slate-200 rounded-xl font-semibold hover:bg-slate-50 transition shadow-sm">
                        Read the Docs
                    </button>
                </div>
            </div>
        </div>

        <!-- Decorative Background Element -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[1000px] h-[600px] bg-gradient-to-b from-blue-50/50 to-transparent rounded-full blur-3xl -z-10"></div>
    </section>

    <!-- Features Grid -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-12">
                <!-- Feature 1 -->
                <div class="group p-8 rounded-3xl border border-slate-100 hover:border-blue-200 hover:shadow-xl hover:shadow-blue-900/5 transition duration-300">
                    <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 text-blue-600 group-hover:scale-110 transition duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Lightning Fast</h3>
                    <p class="text-slate-600">Zero-bloat architecture ensures your applications respond in milliseconds.</p>
                </div>

                <!-- Feature 2 -->
                <div class="group p-8 rounded-3xl border border-slate-100 hover:border-blue-200 hover:shadow-xl hover:shadow-blue-900/5 transition duration-300">
                    <div class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center mb-6 text-purple-600 group-hover:scale-110 transition duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Secure by Design</h3>
                    <p class="text-slate-600">Built-in protection against SQLi, XSS, and CSRF right out of the box.</p>
                </div>

                <!-- Feature 3 -->
                <div class="group p-8 rounded-3xl border border-slate-100 hover:border-blue-200 hover:shadow-xl hover:shadow-blue-900/5 transition duration-300">
                    <div class="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center mb-6 text-emerald-600 group-hover:scale-110 transition duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Modern UI Ready</h3>
                    <p class="text-slate-600">Seamless integration with HTMX, Tailwind, and reactive components.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="font-bold text-slate-400">© 2026 WEBMOL Framework</div>
            <div class="flex space-x-6 text-sm text-slate-500">
                <a href="#" class="hover:text-blue-600">GitHub</a>
                <a href="#" class="hover:text-blue-600">Twitter</a>
                <a href="#" class="hover:text-blue-600">Sponsors</a>
            </div>
        </div>
    </footer>

</body>
</html>