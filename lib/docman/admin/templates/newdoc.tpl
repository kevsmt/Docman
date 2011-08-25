<style type="text/css">
#new-doc-title, #new-doc-tomenu, #new-doc-body {
  position: fixed;
  overflow: hidden;
}

#new-doc-title label,
#new-doc-tomenu label {
  width: 110px;
  display: inline-block;
}

#new-doc-title input,
#new-doc-tomenu input {
  padding: 3px 5px;
  border: 0px !important;
  border-bottom: 1px dotted #ccc !important;
  width: 230px;
}

#new-doc-title {
  left: 250px;
  top: 115px;
  height: 35px;
  width: 350px;
}

#new-doc-tomenu {
  left: 605px;
  top: 115px;
  height: 35px;
  width: 350px;
}

#new-doc-body {
  left: 250px;
  top: 155px;
  right: 10px;
  bottom: 50px;
  resize: none;
}
</style>

<div id="new-doc-title">
  <label>Document Title:</label><input type="text" name="title"/>
</div>
<div id="new-doc-tomenu">
  <label>Attach to Menu:</label><input type="text" name="menu_id"/>
</div>
<textarea id="new-doc-body"></textarea>