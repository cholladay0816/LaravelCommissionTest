<x-agnostic-layout>
    <div class="bg-white" x-data="{ solutions:false, open:false }">
        <main class="mt-12">
            <!-- Hero section -->
            <div class="relative">
                <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gray-100"></div>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="relative shadow-xl sm:rounded-2xl sm:overflow-hidden">
                        <div class="absolute inset-0">
                            <div class="absolute inset-0 bg-gradient-to-r from-sky-400 to-sky-500"></div>
                        </div>
                        <div class="relative px-4 py-16 sm:px-6 sm:py-24 lg:py-32 lg:px-8">
                            <h1 class="hidden">Your all in one commissioning platform.</h1>
                            <div class="text-center text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl">
                                <span class="block text-white">Your all-in-one</span>
                                <span class="block text-sky-200">commissioning platform</span>
                            </div>
                            <p class="mt-6 max-w-lg mx-auto text-center text-xl text-sky-200 sm:max-w-3xl">
                                {{ config('app.name') }} is a commission-based service for digital artists to make money doing what they love.
                            </p>
                            <div class="mt-10 max-w-sm mx-auto sm:max-w-none sm:flex sm:justify-center">
                                <div class="space-y-4 sm:space-y-0 sm:mx-auto sm:inline-grid sm:grid-cols-2 sm:gap-5">
                                    <a href="{{ route('register') }}" class="flex items-center justify-center px-4 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-sky-700 bg-white hover:bg-sky-50 sm:px-8">
                                        Get started
                                    </a>
                                    <a href="{{ route('login') }}" class="flex items-center justify-center px-4 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-sky-800 sm:px-8">
                                        Log in
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logo Cloud -->
            <div class="bg-gray-100">
                <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
                    <p class="text-center text-sm font-semibold uppercase text-gray-500 tracking-wide">
                        Trusted by over 5 very average small businesses
                    </p>
                    <div class="mt-6 grid grid-cols-2 gap-8 md:grid-cols-6 lg:grid-cols-5">
                        <div class="col-span-1 flex justify-center md:col-span-2 lg:col-span-1">
                            <img class="h-12" src="https://tailwindui.com/img/logos/tuple-logo-gray-400.svg" alt="Tuple">
                        </div>
                        <div class="col-span-1 flex justify-center md:col-span-2 lg:col-span-1">
                            <img class="h-12" src="https://tailwindui.com/img/logos/mirage-logo-gray-400.svg" alt="Mirage">
                        </div>
                        <div class="col-span-1 flex justify-center md:col-span-2 lg:col-span-1">
                            <img class="h-12" src="https://tailwindui.com/img/logos/statickit-logo-gray-400.svg" alt="StaticKit">
                        </div>
                        <div class="col-span-1 flex justify-center md:col-span-2 md:col-start-2 lg:col-span-1">
                            <img class="h-12" src="https://tailwindui.com/img/logos/transistor-logo-gray-400.svg" alt="Transistor">
                        </div>
                        <div class="col-span-2 flex justify-center md:col-span-2 md:col-start-4 lg:col-span-1">
                            <img class="h-12" src="https://tailwindui.com/img/logos/workcation-logo-gray-400.svg" alt="Workcation">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alternating Feature Sections -->
            <div class="relative pt-16 pb-32 overflow-hidden">
                <div aria-hidden="true" class="absolute inset-x-0 top-0 h-48 bg-gradient-to-b from-gray-100"></div>
                <div class="relative">
                    <div class="lg:mx-auto lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-2 lg:grid-flow-col-dense lg:gap-24">
                        <div class="px-4 max-w-xl mx-auto sm:px-6 lg:py-16 lg:max-w-none lg:mx-0 lg:px-0">
                            <div>
                                <div>
                <span class="h-12 w-12 rounded-md flex items-center justify-center bg-gradient-to-r from-blue-600 to-sky-600">
                  <!-- Heroicon name: outline/inbox -->
                  <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                  </svg>
                </span>
                                </div>
                                <div class="mt-6">
                                    <h2 class="text-3xl font-extrabold tracking-tight text-gray-900">
                                        Stay on top of commissions
                                    </h2>
                                    <p class="mt-4 text-lg text-gray-500">
                                        Our tools will help you track and coordinate your commissions, so you always know what's next.
                                    </p>
                                    <div class="mt-6">
                                        <a href="{{ route('register') }}" class="inline-flex px-4 py-2 text-base font-medium rounded-md shadow-sm text-white bg-gradient-to-r from-blue-600 to-sky-600 hover:from-blue-700 hover:to-sky-700">
                                            Get started
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-8 border-t border-gray-200 pt-6">
                                <blockquote>
                                    <div>
                                        <p class="text-base text-gray-500">
                                            &ldquo;CreatorCore is incredibly effective for tracking my commissions, and it doesn't cost me a cent!&rdquo;
                                        </p>
                                    </div>
                                    <footer class="mt-3">
                                        <div class="flex items-center space-x-3">
                                            <div class="flex-shrink-0">
                                                <img class="h-6 w-6 rounded-full" src="https://images.unsplash.com/photo-1509783236416-c9ad59bae472?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=1024&h=1024&q=80" alt="">
                                            </div>
                                            <div class="text-base font-medium text-gray-700">
                                                Marcia Hill, Digital Marketing Manager
                                            </div>
                                        </div>
                                    </footer>
                                </blockquote>
                            </div>
                        </div>
                        <div class="mt-12 sm:mt-16 lg:mt-0">
                            <div class="pl-4 -mr-48 sm:pl-6 md:-mr-16 lg:px-0 lg:m-0 lg:relative lg:h-full">
                                <img class="w-full rounded-xl shadow-xl ring-1 ring-black ring-opacity-5 lg:absolute lg:left-0 lg:h-full lg:w-auto lg:max-w-none" src="{{ asset('img/welcome/commission-show.png') }}" alt="Inbox user interface">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-24">
                    <div class="lg:mx-auto lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-2 lg:grid-flow-col-dense lg:gap-24">
                        <div class="px-4 max-w-xl mx-auto sm:px-6 lg:py-32 lg:max-w-none lg:mx-0 lg:px-0 lg:col-start-2">
                            <div>
                                <div>
                                    <span class="h-12 w-12 rounded-md flex items-center justify-center bg-gradient-to-r from-blue-500 to-sky-400">
                                      <!-- Heroicon name: outline/sparkles -->
                                      <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                      </svg>
                                    </span>
                                </div>
                                <div class="mt-6">
                                    <h2 class="text-3xl font-extrabold tracking-tight text-gray-900">
                                        Commission comfortably and safely
                                    </h2>
                                    <p class="mt-4 text-lg text-gray-500">
                                        We offer an incredibly flexible commission process,
                                        which allows you to name your price and deadline.
                                        We have many safeguards in place to prevent unfair play on both sides,
                                        meaning you never have to worry about wasting your time and money.
                                    </p>
                                    <div class="mt-6">
                                        <a href="{{ route('explore') }}" class="inline-flex px-4 py-2 text-base font-medium rounded-md shadow-sm text-white bg-gradient-to-r from-blue-500 to-sky-400 hover:from-blue-700 hover:to-sky-600">
                                            Find a Creator
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-12 sm:mt-16 lg:mt-0 lg:col-start-1">
                            <div class="pr-4 -ml-48 sm:pr-6 md:-ml-16 lg:px-0 lg:m-0 lg:relative lg:h-full">
                                <img class="w-full rounded-xl shadow-xl ring-1 ring-black ring-opacity-5 lg:absolute lg:right-0 lg:h-full lg:w-auto lg:max-w-none" src="{{ asset('img/welcome/commission-show.png') }}" alt="Customer profile user interface">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gradient Feature Section -->
            <div class="bg-gradient-to-r from-sky-600 to-sky-800">
                <div class="max-w-4xl mx-auto px-4 py-16 sm:px-6 sm:pt-20 sm:pb-24 lg:max-w-7xl lg:pt-24 lg:px-8">
                    <h2 class="text-3xl font-extrabold text-white tracking-tight">
                        How {{ config('app.name') }} benefits you
                    </h2>
                    <p class="mt-4 max-w-3xl text-lg text-purple-200">
                        {{ config('app.name') }} is the first truly creator-first platform, designed as a powerful tool for creators to
                        succeed.  Learn more about how we achieve this below:
                    </p>
                    <div class="mt-12 grid grid-cols-1 gap-x-6 gap-y-12 sm:grid-cols-2 lg:mt-16 lg:grid-cols-4 lg:gap-x-8 lg:gap-y-16">
                        <div>
                            <div>
                              <span class="flex items-center justify-center h-12 w-12 rounded-md bg-white bg-opacity-10">
                                <!-- Heroicon name: outline/inbox -->
                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                              </span>
                            </div>
                            <div class="mt-6">
                                <h3 class="text-lg font-medium text-white">Stay Notified</h3>
                                <p class="mt-2 text-base text-purple-200">
                                    Our services track the progress of your order and keep you updated with notifications and emails.
                                    You'll always be able to check the status of your order and review your commission.
                                </p>
                            </div>
                        </div>

                        <div>
                            <div>
              <span class="flex items-center justify-center h-12 w-12 rounded-md bg-white bg-opacity-10">
                <!-- Heroicon name: outline/users -->
                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
              </span>
                            </div>
                            <div class="mt-6">
                                <h3 class="text-lg font-medium text-white">Messaging</h3>
                                <p class="mt-2 text-base text-purple-200">
                                    Ac tincidunt sapien vehicula erat auctor pellentesque rhoncus. Et magna sit morbi lobortis.
                                </p>
                            </div>
                        </div>

                        <div>
                            <div>
              <span class="flex items-center justify-center h-12 w-12 rounded-md bg-white bg-opacity-10">
                <!-- Heroicon name: outline/trash -->
                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
              </span>
                            </div>
                            <div class="mt-6">
                                <h3 class="text-lg font-medium text-white">Dispute System</h3>
                                <p class="mt-2 text-base text-purple-200">
                                    If your order hasn't been completed properly, you can file a dispute to have a moderator review the order.
                                    We take disputes very seriously and will take swift and decisive action.
                                </p>
                            </div>
                        </div>

                        <div>
                            <div>
                              <span class="flex items-center justify-center h-12 w-12 rounded-md bg-white bg-opacity-10">
                                <!-- Heroicon name: outline/pencil-alt -->
                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                              </span>
                            </div>
                            <div class="mt-6">
                                <h3 class="text-lg font-medium text-white">Reviews</h3>
                                <p class="mt-2 text-base text-purple-200">
                                    Ac tincidunt sapien vehicula erat auctor pellentesque rhoncus. Et magna sit morbi lobortis.
                                </p>
                            </div>
                        </div>

                        <div>
                            <div>
                              <span class="flex items-center justify-center h-12 w-12 rounded-md bg-white bg-opacity-10">
                                <!-- Heroicon name: outline/document-report -->
                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                              </span>
                            </div>
                            <div class="mt-6">
                                <h3 class="text-lg font-medium text-white">$0 Commission Fee</h3>
                                <p class="mt-2 text-base text-purple-200">
                                    We promise to never take a single cent of your hard earned money.  All our expenses are paid upfront as a
                                    {{ number_format(config('commission.sales_tax') * 100, 0) }}% sales fee, meaning our creators never foot the bill.
                                </p>
                            </div>
                        </div>

                        <div>
                            <div>
                              <span class="flex items-center justify-center h-12 w-12 rounded-md bg-white bg-opacity-10">
                                <!-- Heroicon name: outline/reply -->
                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                </svg>
                              </span>
                            </div>
                            <div class="mt-6">
                                <h3 class="text-lg font-medium text-white">Easy-to-use Dashboard</h3>
                                <p class="mt-2 text-base text-purple-200">
                                    Our platform makes it easy to read, access, and interact with your orders.
                                    We extensively iterated the layout to make it as easy as possible to interact
                                    with your clients.
                                </p>
                            </div>
                        </div>

                        <div>
                            <div>
                              <span class="flex items-center justify-center h-12 w-12 rounded-md bg-white bg-opacity-10">
                                <!-- Heroicon name: outline/chat-alt -->
                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                              </span>
                            </div>
                            <div class="mt-6">
                                <h3 class="text-lg font-medium text-white">Email Commenting</h3>
                                <p class="mt-2 text-base text-purple-200">
                                    Ac tincidunt sapien vehicula erat auctor pellentesque rhoncus. Et magna sit morbi lobortis.
                                </p>
                            </div>
                        </div>

                        <div>
                            <div>
                              <span class="flex items-center justify-center h-12 w-12 rounded-md bg-white bg-opacity-10">
                                <!-- Heroicon name: outline/heart -->
                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                              </span>
                            </div>
                            <div class="mt-6">
                                <h3 class="text-lg font-medium text-white">Connect with Customers</h3>
                                <p class="mt-2 text-base text-purple-200">
                                    Ac tincidunt sapien vehicula erat auctor pellentesque rhoncus. Et magna sit morbi lobortis.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats section -->
            <div class="relative bg-gray-900">
                <div class="h-80 absolute bottom-0 xl:inset-0 xl:h-full xl:w-full">
                    <div class="h-full w-full xl:grid xl:grid-cols-2">
                        <div class="h-full xl:relative xl:col-start-2">
                            <img class="h-full w-full object-cover opacity-25 xl:absolute xl:inset-0" src="https://images.unsplash.com/photo-1521737852567-6949f3f9f2b5?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=2830&q=80&sat=-100" alt="People working on laptops">
                            <div aria-hidden="true" class="absolute inset-x-0 top-0 h-32 bg-gradient-to-b from-gray-900 xl:inset-y-0 xl:left-0 xl:h-full xl:w-32 xl:bg-gradient-to-r"></div>
                        </div>
                    </div>
                </div>
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8 xl:grid xl:grid-cols-2 xl:grid-flow-col-dense xl:gap-x-8">
                    <div class="relative pt-12 pb-64 sm:pt-24 sm:pb-64 xl:col-start-1 xl:pb-24">
                        <h2 class="text-sm font-semibold tracking-wide uppercase">
                            <span class="text-sky-300">Valuable Metrics</span>
                        </h2>
                        <p class="mt-3 text-3xl font-extrabold text-white">Get actionable data that will help grow your business</p>
                        <p class="mt-5 text-lg text-gray-300">Rhoncus sagittis risus arcu erat lectus bibendum. Ut in adipiscing quis in viverra tristique sem. Ornare feugiat viverra eleifend fusce orci in quis amet. Sit in et vitae tortor, massa. Dapibus laoreet amet lacus nibh integer quis. Eu vulputate diam sit tellus quis at.</p>
                        <div class="mt-12 grid grid-cols-1 gap-y-12 gap-x-6 sm:grid-cols-2">
                            <p>
                                <span class="block text-2xl font-bold text-white">8K+</span>
                                <span class="mt-1 block text-base text-gray-300"><span class="font-medium text-white">Companies</span> use laoreet amet lacus nibh integer quis.</span>
                            </p>

                            <p>
                                <span class="block text-2xl font-bold text-white">25K+</span>
                                <span class="mt-1 block text-base text-gray-300"><span class="font-medium text-white">Countries around the globe</span> lacus nibh integer quis.</span>
                            </p>

                            <p>
                                <span class="block text-2xl font-bold text-white">98%</span>
                                <span class="mt-1 block text-base text-gray-300"><span class="font-medium text-white">Customer satisfaction</span> laoreet amet lacus nibh integer quis.</span>
                            </p>

                            <p>
                                <span class="block text-2xl font-bold text-white">12M+</span>
                                <span class="mt-1 block text-base text-gray-300"><span class="font-medium text-white">Issues resolved</span> lacus nibh integer quis.</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="bg-white">
                <div class="max-w-4xl mx-auto py-16 px-4 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8 lg:flex lg:items-center lg:justify-between">
                    <h2 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                        <span class="block">Ready to start earning?</span>
                        <span class="block bg-gradient-to-r from-blue-600 to-sky-600 bg-clip-text text-transparent">Get in touch or create an account.</span>
                    </h2>
                    <div class="mt-6 space-y-4 sm:space-y-0 sm:flex sm:space-x-5">
                        <a href="#" class="flex items-center justify-center px-4 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-gradient-to-r from-blue-600 to-sky-600 hover:from-sky-700 hover:to-sky-700">
                            Learn more
                        </a>
                        <a href="{{ route('register') }}" class="flex items-center justify-center px-4 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-sky-800 bg-sky-50 hover:bg-sky-100">
                            Get started
                        </a>
                    </div>
                </div>
            </div>
        </main>

        <footer class="" aria-labelledby="footerHeading">
            <h2 id="footerHeading" class="sr-only">Footer</h2>
            <div class="max-w-7xl mx-auto pb-8 px-4 sm:px-6 lg:px-8">
                <div class="border-t border-gray-200 pt-8 md:flex md:items-center md:justify-between">
                    <div class="flex space-x-6 md:order-2">
                        <a href="{{config('social.facebook')}}" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                            </svg>
                        </a>

                        <a href="{{config('social.instagram')}}" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                            </svg>
                        </a>

                        <a href="{{config('social.twitter')}}" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>

                        <a href="{{config('social.github')}}" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">GitHub</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                    <p class="mt-8 text-base text-gray-400 md:mt-0 md:order-1">
                        &copy; 2021 Holladay Digital LLC. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </div>

</x-agnostic-layout>
