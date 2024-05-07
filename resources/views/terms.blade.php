<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Terms - Philcoastal</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="container mx-auto p-4">
        <!-- App Logo and Back Button -->
        <div class="flex items-center justify-between px-4 py-2">
            <img src="logo/logo-1.png" alt="Philcoastal Logo" class="h-12"> <!-- Adjust path as necessary -->
            <!-- Back button code commented out -->
        </div>

        <div class="max-w-4xl mx-auto bg-white border-t-4 border-red-600 rounded-lg shadow-xl" style="font-family: 'Inter', sans-serif">
            <div class="p-6">
                <h1 class="text-3xl font-bold text-center mb-4">Terms and Conditions</h1>
                <p class="text-gray-600 text-lg">
                    Welcome to Philcoastal's Vendor Management Portal. These terms and conditions outline the rules and regulations for the use of our portal.
                </p>
                <section class="mt-6">
                    <h2 class="text-red-700 text-xl font-bold">1. General Terms</h2>
                    <p>
                        By accessing this portal, you agree to be bound by these terms and conditions. If you disagree with any part of the terms, then you do not have permission to access the service.
                    </p>
                </section>
                <section class="mt-4">
                    <h2 class="text-red-700 text-xl font-bold">2. Use of the Portal</h2>
                    <p>
                        As a vendor on our portal, you agree to provide honest and accurate information and to conduct yourself in a professional manner consistent with the standards of our industry.
                    </p>
                </section>
                <section class="mt-4">
                    <h2 class="text-red-700 text-xl font-bold">3. Compliance with Laws</h2>
                    <p>
                        You agree to comply with all local, state, and federal regulations and laws applicable to your use of the portal and your business operations.
                    </p>
                </section>
                <section class="mt-4">
                    <h2 class="text-red-700 text-xl font-bold">4. Termination</h2>
                    <p>
                        We may terminate or suspend access to our portal immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach the Terms.
                    </p>
                </section>
                <section class="mt-4">
                    <h2 class="text-red-700 text-xl font-bold">5. Amendments to Terms</h2>
                    <p>
                        We reserve the right to amend terms at any time. When amended, we will provide notice to you either through the website interface or via email.
                    </p>
                </section>
                <section class="mt-4 mb-8">
                    <h2 class="text-red-700 text-xl font-bold">6. Contact Us</h2>
                    <p>
                        If you have any questions about these Terms, please contact us at support@philcoastal.com.
                    </p>
                </section>
            </div>
        </div>
    </div>
</body>
<style>
    /* Styling for the underline effect on hover is responsive */
    .auth-link {
        background: transparent;
        color: rgb(0, 0, 0);
        padding: 4px 16px;
        transition: all 0.3s ease-in-out;
        position: relative;
        display: inline-block;
        text-decoration: none;
    }
    .auth-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 3px; /* Thickness of the underline */
        background-color: rgba(221, 5, 5, 0.884); /* Color of the underline */
        bottom: 0;
        left: 50%;
        transition: all 0.3s ease-in-out;
    }
    .auth-link:hover::after {
        width: 100%;
        left: 0;
    }
</style>
</html>
