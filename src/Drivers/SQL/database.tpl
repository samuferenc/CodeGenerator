<!doctype html>
<html>
  <head>
    <style>
      body { margin: 5px; font-family: "calibri" }      
    </style>
  </head>
  <body>
    <h1>Database</h1>
    {foreach from=$tables item=table}
      <hr>
      <h2>{$table.name}</h2>   
      <table>
        <tr><th>Name</th><th>Type</th></tr>
        {foreach from=$table.columns item=column}
          <tr><td>{$column.name}</td><td>{$column.type}</td></tr>
        {/foreach}
      </table>
    {/foreach}
  </body>
</html>