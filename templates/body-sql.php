<div class="jumbotron slim">
  <div class="container">
    <h2>SQL Admin Panel</h2>
  </div>
</div>

<div class="container">
<form id="sql-form" class="form-horizontal">
  <fieldset>
  <div class="form-group">
    <label for="rawsql">Enter a raw SQL query string:</label>
    <textarea class="form-control input-xlg" rows="3" id="rawsql" placeholder="Enter SQL Query" />
  </div>
  </fieldset>
  <h2 class="press-enter" style="display: none;">(press enter to execute query)</h2>
  <table id="sql-results" class="table" style="display: none;">
  </table>
</div>
