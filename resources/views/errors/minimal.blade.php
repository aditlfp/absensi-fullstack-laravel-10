<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                        },
                        keyframes: {
                            shadow: {
                                "0%": { width: "27%" },
                                "25%": { width: "30%" },
                                "50%": { width: "60%" },
                                "100%": { width: "27%" },
                            },
                        },
                    animation: {
                        shadow: "shadow 5s ease infinite",
                    },
                },
            },

                daisyui: {
                    themes: ["bumblebee"],
                },

                plugins: [forms, require("daisyui"), require("@tailwindcss/forms")],
            }
          </script>


        <style>
            body {
                font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gradient-to-bl from-yellow-500 to-rose-400/80 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:py-6 sm:px-6 lg:px-8 bg-slate-500/20 py-2 px-2 rounded-md shadow-inner shadow-yellow-800/20">
                <div class="flex justify-center items-center">
                    @yield('icon')
                </div>
                <div class="flex items-center px-2 pt-8 sm:justify-start sm:pt-0 bg-slate-500/20 rounded-md shadow-inner shadow-slate-600/20">
                    <div class="m-4">
                        <div class="px-4 text-lg text-gray-500 border-gray-400 tracking-wider">
                            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-center text-gray-100 mb-4">#@yield('code')</h1>
                        </div>
                        <div class="ml-4 text-lg text-gray-100 uppercase tracking-wider font-bold">
                            @yield('message')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
