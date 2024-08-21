@extends('layouts.app')
@section('content')
<div class="container mx-auto px-6 py-12">
    <!-- Sección de Información de CompraFacil -->
    <div class="space-y-16">
        <!-- Política de Privacidad -->
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-green-700 mb-6">Política de Privacidad de CompraFacil</h2>
            <p class="mb-4"><strong>1. Introducción</strong></p>
            <p class="text-gray-700 mb-4">CompraFacil (en adelante, "nosotros" o "nuestro") se compromete a proteger su privacidad. Esta Política de Privacidad explica cómo recopilamos, usamos, compartimos y protegemos su información personal cuando utiliza nuestro sitio web (en adelante, "el Sitio").</p>
            
            <p class="mb-4"><strong>2. Información que Recopilamos</strong></p>
            <p class="text-gray-700 mb-4"><strong>Información Personal:</strong> Recopilamos información personal que usted nos proporciona al registrarse, hacer un pedido o contactarnos. Esta información puede incluir nombre, dirección de correo electrónico, dirección de envío, número de teléfono y detalles de pago.</p>
            
            <p class="mb-4"><strong>3. Uso de la Información</strong></p>
            <ul class="list-disc list-inside text-gray-700 space-y-2 ml-4">
                <li>Procesar y gestionar sus pedidos.</li>
                <li>Mejorar el Sitio y nuestra oferta de productos.</li>
                <li>Enviarle actualizaciones sobre su pedido y promociones.</li>
                <li>Responder a sus consultas y proporcionar soporte al cliente.</li>
            </ul>
            
            <p class="mb-4 mt-8"><strong>4. Compartición de Información</strong></p>
            <ul class="list-disc list-inside text-gray-700 space-y-2 ml-4">
                <li><strong>Con Proveedores de Servicios:</strong> Podemos compartir su información con proveedores de servicios terceros que nos ayudan a operar el Sitio y a procesar pagos y envíos. Estos proveedores están obligados a mantener la confidencialidad de su información y solo pueden usarla para los fines específicos para los que fueron contratados.</li>
                <li><strong>Por Requerimiento Legal:</strong> Podemos divulgar su información cuando lo requiera la ley, para cumplir con procesos legales, o para proteger nuestros derechos, propiedad o seguridad, y los de nuestros usuarios.</li>
            </ul>
            
            <p class="mb-4 mt-8"><strong>5. Seguridad de la Información</strong></p>
            <p class="text-gray-700 mb-4">Implementamos medidas de seguridad razonables para proteger su información personal contra acceso no autorizado, pérdida o destrucción. Sin embargo, ninguna transmisión de datos por Internet es completamente segura, y no podemos garantizar la seguridad absoluta de su información.</p>
            
            <p class="text-gray-700 mb-4"><strong>Cambios a esta Política</strong></p>
            <p class="text-gray-700">Podemos actualizar esta Política de Privacidad de vez en cuando. Los cambios se publicarán en esta página y entrarán en vigor al momento de su publicación. Le recomendamos revisar periódicamente esta política para estar informado sobre cómo protegemos su información.</p>
        </div>
        
        <!-- Sobre Nosotros -->
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-green-700 mb-6">Sobre Nosotros</h2>
            <p class="text-gray-700 mb-4"><strong>CompraFacil: Simplificando tus Compras de Despensa</strong></p>
            <p class="text-gray-700 mb-6">En CompraFacil, nuestro objetivo es transformar la manera en que adquieres tus despensas y productos de primera necesidad. Fundada en 2024, nuestra misión es ofrecer una experiencia de compra en línea conveniente, segura y eficiente para nuestros clientes.</p>
            
            <h3 class="text-xl font-semibold text-green-600 mt-8 mb-4">Nuestra Misión</h3>
            <p class="text-gray-700 mb-6">Nos dedicamos a proporcionar una amplia variedad de productos de alta calidad que satisfagan tus necesidades diarias. Creemos en la simplicidad y en hacer que el proceso de compra sea lo más sencillo posible, para que puedas centrarte en lo que realmente importa.</p>
            
            <h3 class="text-xl font-semibold text-green-600 mt-8 mb-4">Nuestros Valores</h3>
            <ul class="list-disc list-inside text-gray-700 space-y-2 ml-4">
                <li><strong>Compromiso con la Calidad:</strong> Seleccionamos cuidadosamente nuestros productos para garantizar que solo ofrezcamos lo mejor para ti y tu familia.</li>
                <li><strong>Servicio al Cliente:</strong> Valoramos a nuestros clientes y estamos comprometidos a ofrecer un servicio de atención excepcional. Tu satisfacción es nuestra prioridad.</li>
                <li><strong>Innovación y Eficiencia:</strong> Utilizamos tecnología de vanguardia para mejorar continuamente nuestra plataforma y ofrecerte una experiencia de compra fluida y segura.</li>
            </ul>
            
            <h3 class="text-xl font-semibold text-green-600 mt-8 mb-4">¿Por qué Elegirnos?</h3>
            <ul class="list-disc list-inside text-gray-700 space-y-2 ml-4">
                <li><strong>Variedad y Conveniencia:</strong> Encuentra una extensa gama de productos en un solo lugar, con la comodidad de comprar desde tu hogar.</li>
                <li><strong>Precios Competitivos:</strong> Ofrecemos precios justos y transparentes, sin sorpresas al momento de pagar.</li>
                <li><strong>Entrega Rápida y Segura:</strong> Nos aseguramos de que tus pedidos lleguen a tiempo y en perfectas condiciones.</li>
            </ul>
            
            <h3 class="text-xl font-semibold text-green-600 mt-8 mb-4">Nuestro Compromiso</h3>
            <p class="text-gray-700">En CompraFacil, estamos aquí para hacer que tu vida sea un poco más fácil. Nos enorgullece ser tu socio confiable en la compra de despensas y estamos constantemente trabajando para superar tus expectativas.</p>
            <p class="text-gray-700 mt-4">Gracias por elegirnos. Estamos emocionados de ser parte de tu rutina diaria y esperamos servirte con excelencia.</p>
        </div>
        
        <!-- Sección de Contacto -->
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-green-700 mb-6">Contacto</h2>
            <p class="text-gray-700 mb-4">Si tienes alguna pregunta o necesitas ayuda, no dudes en contactarnos a través de los siguientes medios:</p>
            <ul class="list-disc list-inside text-gray-700 space-y-2 ml-4">
                <li><strong>Correo Electrónico:</strong> <a href="mailto:soporte@comprafacil.com" class="text-green-600 hover:underline">soporte@comprafacil.com</a></li>
                <li><strong>Teléfono:</strong> +52 123 456 7890</li>
                <li><strong>Redes Sociales:</strong> Síguenos en nuestras redes para estar al tanto de nuestras últimas ofertas.</li>
            </ul>
        </div>
        
        <!-- Sección de Términos y Condiciones -->
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-green-700 mb-6">Términos y Condiciones</h2>
            <p class="text-gray-700 mb-4"><strong>1. Introducción</strong></p>
            <p class="text-gray-700 mb-4">Estos términos y condiciones describen las reglas y regulaciones para el uso del sitio web de CompraFacil.</p>
            
            <p class="text-gray-700 mb-4"><strong>2. Pedidos y Pagos</strong></p>
            <p class="text-gray-700 mb-4">Al realizar un pedido en nuestro sitio, aceptas proporcionar información precisa y completa.</p>
            
            <p class="text-gray-700 mb-4"><strong>3. Entregas</strong></p>
            <p class="text-gray-700 mb-4">Nos comprometemos a entregar los productos en la dirección que nos proporciones en el menor tiempo posible.</p>
            
            <p class="text-gray-700 mb-4"><strong>4. Devoluciones y Reembolsos</strong></p>
            <p class="text-gray-700 mb-4">Si no estás satisfecho con tu compra, contáctanos dentro de los 7 días hábiles para procesar un reembolso o cambio.</p>
            
            <p class="text-gray-700 mb-4"><strong>5. Cambios a los Términos</strong></p>
            <p class="text-gray-700">Nos reservamos el derecho de modificar estos términos en cualquier momento. Te recomendamos revisar esta página periódicamente para estar informado de cualquier cambio.</p>
        </div>
    </div>
</div>
<br>
<br>
<br>
@endsection
