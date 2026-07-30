import re

with open('tailwind.config.js', 'r') as f:
    content = f.read()

# Replace brand colors block
old_brand = """                brand: {
                    50: '#f0fdfa',
                    100: '#ccfbf1',
                    200: '#99f6e4',
                    300: '#5eead4',
                    400: '#2dd4bf',
                    500: '#14b8a6', // Base Teal
                    600: '#0d9488', // Primary Teal
                    700: '#0f766e',
                    800: '#115e59',
                    900: '#134e4a',
                    950: '#042f2e',
                },"""

new_brand = """                brand: {
                    50: '#f8fafc',
                    100: '#f1f5f9',
                    200: '#e2e8f0',
                    300: '#cbd5e1',
                    400: '#94a3b8',
                    500: '#475569', // Base Slate/Charcoal
                    600: '#334155', // Primary Hover
                    700: '#1e293b', // Deep Slate
                    800: '#0f172a',
                    900: '#020617',
                    950: '#000000',
                },"""

if old_brand in content:
    content = content.replace(old_brand, new_brand)
    with open('tailwind.config.js', 'w') as f:
        f.write(content)
    print("SUCCESS")
else:
    print("FAILED")
