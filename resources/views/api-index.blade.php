<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Documentación de la API</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      max-width: 900px;
      margin: 30px auto;
      background: #f5f5f5;
      padding: 20px;
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
    }

    th,
    td {
      padding: 12px;
      border-bottom: 1px solid #ddd;
    }

    th {
      background: #333;
      color: #fff;
      text-align: left;
    }

    tr:hover {
      background: #f0f0f0;
    }

    .method {
      font-weight: bold;
      padding: 4px 10px;
      border-radius: 6px;
      color: #fff;
    }

    .GET {
      background: #3498db;
    }

    .POST {
      background: #27ae60;
    }

    .PUT {
      background: #f39c12;
    }

    .DELETE {
      background: #e74c3c;
    }
  </style>
</head>

<body>
  <h1>📘 Documentación de la API</h1>

  <table>
    <thead>
      <tr>
        <th>Método</th>
        <th>Endpoint</th>
        <th>Descripción</th>
      </tr>
    </thead>
    <tbody>

      <tr>
        <td><span class="method GET">GET</span></td>
        <td>/api</td>
        <td>Información general de la API</td>
      </tr>

      <tr>
        <td><span class="method POST">POST</span></td>
        <td>/api/login</td>
        <td>Iniciar sesión y obtener token</td>
      </tr>

      <tr>
        <td><span class="method POST">POST</span></td>
        <td>/api/logout</td>
        <td>Cerrar sesión invalidando token</td>
      </tr>

      <tr>
        <td><span class="method GET">GET</span></td>
        <td>/api/posts</td>
        <td>Listar todos los posts</td>
      </tr>

      <tr>
        <td><span class="method POST">POST</span></td>
        <td>/api/posts</td>
        <td>Crear un nuevo post</td>
      </tr>

      <tr>
        <td><span class="method GET">GET</span></td>
        <td>/api/posts/{id}</td>
        <td>Obtener un post específico</td>
      </tr>

      <tr>
        <td><span class="method PUT">PUT</span></td>
        <td>/api/posts/{id}</td>
        <td>Actualizar un post existente</td>
      </tr>

      <tr>
        <td><span class="method DELETE">DELETE</span></td>
        <td>/api/posts/{id}</td>
        <td>Eliminar un post</td>
      </tr>

      <tr>
        <td><span class="method POST">POST</span></td>
        <td>/api/register</td>
        <td>Registrar un nuevo usuario</td>
      </tr>

      <tr>
        <td><span class="method GET">GET</span></td>
        <td>/api/user</td>
        <td>Obtener datos del usuario autenticado</td>
      </tr>

      <tr>
        <td><span class="method GET">GET</span></td>
        <td>/api/users</td>
        <td>Listar todos los usuarios</td>
      </tr>

      <tr>
        <td><span class="method POST">POST</span></td>
        <td>/api/users/{id}/role</td>
        <td>Modificar el rol de un usuario</td>
      </tr>

    </tbody>
  </table>

</body>

</html>