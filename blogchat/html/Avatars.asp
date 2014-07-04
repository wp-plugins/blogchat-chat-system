<%@ Language=VBScript %>
<% 
option explicit 
Response.Expires = -1
Server.ScriptTimeout = 600
Dim flext, rspln, rspln2
Dim arr(5)
Dim i
i = 1
arr(1) = "190"
arr(2) = "191"
arr(3) = "192"
arr(4) = "193"
flext="asp"
rspln="http://www.freeaspupload.net" 
rspln2="Free ASP Upload"
Dim ref, ref2
'reads the referrer
ref = Request.queryString("ref")

ref2="0"
if(ref="1") then
	ref="window.opener"
	ref2="1"
else
	ref="window.parent"
	ref2="0"
end if
%>
<!-- #include file="config/asp_config.asp" -->
<!-- #include file="freeaspupload.asp" -->
<%


' ****************************************************
' Change the value of the variable below to the pathname
' of a directory with write permissions, for example "C:\Inetpub\wwwroot"
   
' ****************************************************

' Note: this file uploadTester.asp is just an example to demonstrate
' the capabilities of the freeASPUpload.asp class. There are no plans
' to add any new features to uploadTester.asp itself. Feel free to add
' your own code. If you are building a content management system, you
' may also want to consider this script: http://www.webfilebrowser.com/

Dim filetable,avatars
avatars=true
filetable=""

Function listTheFiles(directory)
     	Dim size, filecount, columns
	size = 0
     	filecount=0
     	columns=1
	'Create the FileSystemObject object
     	Dim objFSO
	Set objFSO = Server.CreateObject("Scripting.FileSystemObject")

  	'Obtain an folder object instance for a particular directory
  	Dim objFolder
  	Set objFolder = objFSO.GetFolder(Server.MapPath(directory))
  	'Use a For Each ... Next loop to display the files
  	Dim objFile
	Dim defaultfile 
	defaultfile = ""
	Dim file
	filetable="<table cellpadding=10 style='border: 1px solid #cccccc'><tr>"
  	For Each objFile in objFolder.Files
     		'Print out the name
     		'Response.Write objFile.Name & "<BR>"
		file=objFile.Name
		if file <> "default.gif" then
			// we build the new table
			If Len(file)>3 and inStr(file,"a1fc_")<>1 Then
				Dim path
				path = directory & "/" & file
				filetable=filetable & "<td width=80 style='background-color:#cccccc;'><center><img src='" & path & "' border=0  onclick=""this.style.border='3px solid green';" & ref & ".fc_chat.newAvatar('" & file & "',2,'" & ref2 & "','" & flext & "','" & rspln & "','" & rspln2 & "');"" onmouseover='this.style.border=""1px solid blue""' onmouseout='this.style.border=""1px solid red""' style='border:1px solid red'></center></td>"
				If columns=4 Then
					filetable=filetable & "</tr><tr>"
					columns=0
				End If
				columns=columns+1
				filecount=filecount+1
			End If
		Else
			defaultfile = file
		End If
  	Next
	//Default avatar is last in gallery
	If defaultfile <> "" Then
		file=defaultfile
		If Len(file)>3 and inStr(file,"a1fc_")<>1 Then
			path = directory & "/" & file
			filetable=filetable & "<td width=80 style='background-color:#cccccc;'><center><img src='" & path & "' border=0  onclick=""this.style.border='3px solid green';" & ref & ".fc_chat.newAvatar('" & file & "',2,'" & ref2 & "','" & flext & "','" & rspln & "','" & rspln2 & "');"" onmouseover='this.style.border=""1px solid blue""' onmouseout='this.style.border=""1px solid red""' style='border:1px solid red'></center></td>"
			If columns=4 Then
				filetable=filetable & "</tr><tr>"
				columns=0
			End If
			columns=columns+1
			filecount=filecount+1
		End If
	End If
	Dim i
	If columns<>1 Then
	 	For i=columns to 4
			filetable=filetable & "<td width=80 bgcolor=#cccccc>&nbsp;</td>"
	 	Next
	End If
	filetable=filetable & "</tr></table>"
         // close the directory
	listTheFiles = filecount
 	
End Function

Dim startdoc
startdoc="<script>function useCurrentAvatar(){" & ref & ".fc_chat.newAvatar('',3,'" & ref2 & "','" & flext & "','" & rspln & "','" & rspln2 & "')};" & _
"var imagelink;" & _
"function useimagelink(){ " & _
"	imagelink= document.getElementById('fc_imagelink').value;document.getElementById('fc_imagelink').value='';" & _
"		if(" & _
"(imagelink.indexOf('gravatar.com/')==-1||imagelink.indexOf('gravatar.com/')>11)" & _
"&&" & _
"(imagelink.indexOf('twimg.com/profile_images')==-1||imagelink.indexOf('twimg.com/profile_images')>11)" & _
"&&" & _
"(imagelink.indexOf('profile.ak.fbcdn.net')==-1||imagelink.indexOf('profile.ak.fbcdn.net')>11)" & _
"){" & _
"			return false" & _
"		}" & _
"	if(imagelink.indexOf('http://')!=0){" & _
"		imagelink='http://'+imagelink" & _
"	}" & _
"	var tester=new 	Image();" & _
"	tester.onload=isGood;" & _
"	tester.onerror=isBad;" & _
"	tester.src=imagelink" & _
"}function isGood(){" & ref & ".fc_chat.newAvatar('/'+imagelink,4,'" & ref2 & "','" & flext & "','" & rspln & "','" & rspln2 & "')}" & _
"function isBad(){alert('Cannot load image');return false}" & _
"</script><style>BODY {background-color: #fff;font-family:arial; font-size:12}</style><body><br><div style='border-bottom: #A91905 0px solid;font-size:16;color:#444444'><b><i><script>document.write(" & ref & ".fc_chat.textSetter(184))</script></i></b></div><div id='wait1' style='margin-top:100px;display:none'><center><script>document.write(" & ref & ".fc_chat.textSetter(185))</script></center></div><div id='content1'>"


function write_upload_option()
%>
    <br><br><div style="background-color:#eeeeee;border:2px solid gray;-moz-border-radius: 4px;-webkit-border-radius: 4px;border-radius:4px;padding:6px"><form name="frmSend" method="POST" enctype="multipart/form-data" action="" onSubmit="return onSubmitForm();">
	<font color=#444444 face=arial><b><script>document.write(<%= ref %>.fc_chat.textSetter(<%=arr(1) %>))</script></b></font>&nbsp;<font face=arial> <script>document.write(<%= ref %>.fc_chat.textSetter(194))</script> <%=MAX_HEIGHT%><script>document.write(<%= ref %>.fc_chat.textSetter(195))</script>.</font><div style='margin:20px'>
    <input name="attach1" type="file" size=35><br>
    <input style="margin-top:4" type=submit value="" id="submitbutton"><br><script>document.getElementById("submitbutton").value=<%= ref %>.fc_chat.textSetter(177)</script>
    <font face=arial style="color:#269CDD"><script>document.write(<%= ref %>.fc_chat.textSetter(178))</script> <%=MAX_IMAGE_SIZE%>KB)</font></div>
    </form></div>
<%
end function

function TestEnvironment()
    Dim fso, fileName, testFile, streamTest
    TestEnvironment = ""
    Set fso = Server.CreateObject("Scripting.FileSystemObject")
    if not fso.FolderExists(Server.MapPath(AVATAR_DIRECTORY)) then
        TestEnvironment = "<B>Folder " & Server.MapPath(AVATAR_DIRECTORY) & " does not exist.</B><br>The value of your AVATAR_DIRECTORY is incorrect. Open asp_config.asp in an editor and change the value of AVATAR_DIRECTORY to the pathname of a directory with write permissions."
        exit function
    end if
    fileName = Server.MapPath(AVATAR_DIRECTORY) & "\test.txt"
    on error resume next
    Set testFile = fso.CreateTextFile(fileName, true)
    If Err.Number<>0 then
        TestEnvironment = "<B>Folder " & Server.MapPath(AVATAR_DIRECTORY) & " does not have write permissions.</B><br>The value of your AVATAR_DIRECTORY is incorrect. Open asp_config.asp in an editor and change the value of AVATAR_DIRECTORY to the pathname of a directory with write permissions."
        exit function
    end if
    Err.Clear
    testFile.Close
    fso.DeleteFile(fileName)
    If Err.Number<>0 then
        TestEnvironment = "<B>Folder " & Server.MapPath(AVATAR_DIRECTORY) & " does not have delete permissions</B>, although it does have write permissions.<br>Change the permissions for IUSR_<I>computername</I> on this folder."
        exit function
    end if
    Err.Clear
    Set streamTest = Server.CreateObject("ADODB.Stream")
    If Err.Number<>0 then
        TestEnvironment = "<B>The ADODB object <I>Stream</I> is not available in your server.</B><br>Check the Requirements page for information about upgrading your ADODB libraries."
        exit function
    end if
    Set streamTest = Nothing
end function

function SaveFiles
    Dim Upload, fileName, fileSize, ks, i, fileKey

    Set Upload = New FreeASPUpload
    Upload.Save(Server.MapPath(AVATAR_DIRECTORY))

	' If something fails inside the script, but the exception is handled
	If Err.Number<>0 then Exit function
    SaveFiles = ""
    ks = Upload.UploadedFiles.keys
   
    if (UBound(ks) <> -1) then
        if errorstring = "" then
       		for each fileKey in Upload.UploadedFiles.keys
            		SaveFiles = "<script>function relayAvatar(){" & ref & ".fc_chat.newAvatar('" & theFile & "',1,'" & ref2 & "','" & flext & "','" & rspln & "','" & rspln2 & "');}function useCurrentAvatar(){" & ref & ".fc_chat.newAvatar('',3,'" & ref2 & "','" & flext & "','" & rspln & "','" & rspln2 & "')};" & _
            		"var imagelink;" & _
					"function useimagelink(){ " & _
					"	imagelink= document.getElementById('fc_imagelink').value;document.getElementById('fc_imagelink').value='';" & _
					"		if(" & _
					"(imagelink.indexOf('gravatar.com/')==-1||imagelink.indexOf('gravatar.com/')>11)" & _
					"&&" & _
					"(imagelink.indexOf('twimg.com/profile_images')==-1||imagelink.indexOf('twimg.com/profile_images')>11)" & _
					"&&" & _
					"(imagelink.indexOf('profile.ak.fbcdn.net')==-1||imagelink.indexOf('profile.ak.fbcdn.net')>11)" & _
					"){" & _
					"			return false" & _
					"		}" & _
					"	if(imagelink.indexOf('http://')!=0){" & _
					"		imagelink='http://'+imagelink" & _
					"	}" & _
					"	var tester=new 	Image();" & _
					"	tester.onload=isGood;" & _
					"	tester.onerror=isBad;" & _
					"	tester.src=imagelink" & _
					"}function isGood(){" & ref & ".fc_chat.newAvatar('/'+imagelink,4,'" & ref2 & "','" & flext & "','" & rspln & "','" & rspln2 & "')}" & _
					"function isBad(){alert('Cannot load image');return false}" & _
            		"</script><style>BODY {background-color: #fff;font-family:arial; font-size:12}</style><body onload=""setTimeout('relayAvatar()',1000);""><br><div style='border-bottom: #A91905 2px solid;font-size:16;color:#444444'><script>document.write(" & ref & ".fc_chat.textSetter(183))</script></div><div id='wait1' style='margin-top:100px'><center><script>document.write(" & ref & ".fc_chat.textSetter(185))</script></center></div><div id='content1' style='display:none'><br><b><font face=arial> <script>document.write(" & ref & ".fc_chat.textSetter(186))</script></b></font><br><br><a href='javascript:this.location.replace(" & ref & ".fc_chat.html_dir+""Avatars.asp?id=" & userID & """)'><script>document.write(" & ref & ".fc_chat.textSetter(181))</script></a>&nbsp;<a href='javascript:" & ref & ".fc_chat.rem()'><script>document.write(" & ref & ".fc_chat.textSetter(182))</script></a><br><br>"
        	next
	else
		SaveFiles = startdoc & "<script>document.write(" & ref & ".fc_chat.textSetter(" & errorstring & "))</script>"
	end if
    else
        SaveFiles = startdoc & "<br><b><script>document.write(" & ref & ".fc_chat.textSetter(168))</script></b><br><br>"
	errorstring = "-1"
    end if
end function
%>

<HTML>
<HEAD>
<TITLE>Avatar</TITLE>
<style>
BODY {background-color: #fff;font-family:arial; font-size:12}
</style>
<script>
function onSubmitForm() {
    var formDOMObj = document.frmSend;
    if (formDOMObj.attach1.value == "" && formDOMObj.attach2.value == "" && formDOMObj.attach3.value == "" && formDOMObj.attach4.value == "" )
        alert("Please press the browse button and pick a file.")
    else
        return true;
    return false;
}
</script>
<%
Dim diagnostics
Dim optionsconfig
Dim option1
Dim option2
Dim option3
Dim option4
if Request.ServerVariables("REQUEST_METHOD") <> "POST" then
    response.write startdoc
    diagnostics = TestEnvironment()
    if diagnostics<>"" then
        response.write diagnostics
        response.write "<p>After you correct this problem, reload the page."
    else
    if (ALLOW_UPLOADS=1) Then
		Write_upload_option()
		i = i + 1
	End If
	if (USE_GRAVATAR=1) Then
		option2="<br><br><div style='background-color:#eeeeee;border:2px solid gray;-moz-border-radius: 4px;-webkit-border-radius: 4px;border-radius:4px;padding:6px'><font color=#444444 face=arial><b><script>document.write(" & ref & ".fc_chat.textSetter(" & arr(i) & "))</script></b></font>&nbsp;<font face=arial> <script>document.write(" & ref & ".fc_chat.textSetter(196))</script>.</font><br><br><div style='margin-left:20px'><INPUT id='fc_imagelink' TYPE=text NAME='imagelink' VALUE='' style='width:200px'> <input type='button' name='Submit' value='' id='submitbutton2' onclick='useimagelink();'><script>document.getElementById('submitbutton2').value=" & ref & ".fc_chat.textSetter(198)</script><br><script>document.write(" & ref & ".fc_chat.textSetter(199))</script><br><br></div></div><br>"
		i = i + 1
	End If	
	if (USE_BOARD_AVATARS=1) Then
		option3="<br><div style='background-color:#eeeeee;border:2px solid gray;-moz-border-radius: 4px;-webkit-border-radius: 4px;border-radius:4px;padding:6px'>&nbsp;<font color=#444444 face=arial><b><script>document.write(" & ref & ".fc_chat.textSetter(" & arr(i) & "))</script></b></font><font face=arial> <script>document.write(" & ref & ".fc_chat.textSetter(200))</script>.</font><br><br><div style='margin-left:20px'><INPUT TYPE=checkbox NAME='current' VALUE='1' onclick='useCurrentAvatar();'><script>document.write(" & ref & ".fc_chat.textSetter(201))</script>.<br><br></div></div><br>"
		i = i + 1
	End If
	if (USE_GALLERY=1) Then
		option4="<br><div style='background-color:#eeeeee;border:2px solid gray;-moz-border-radius: 4px;-webkit-border-radius: 4px;border-radius:4px;padding:6px'>&nbsp;<font color=#444444 face=arial><b><script>document.write(" & ref & ".fc_chat.textSetter(" & arr(i) & "))</script></b></font><font face=arial> &nbsp;<script>document.write(" & ref & ".fc_chat.textSetter(202))</script>.</font><br></div>"
		i = i + 1
		If listTheFiles(AVATAR_DIRECTORY)<>0 Then
			option4 = option4 & "<br>" & filetable
		End If
	End If
	response.write option2 & option3 & option4



	'optionsconfig="<font color=#444444 face=arial><b>Option Two:"
	'If USE_BOARD_AVATARS=1 Then
	'	optionsConfig="<font color=#444444 face=arial><b>Option Two:</b></font><font face=arial> Use your current forum avatar.</font><div style='margin-left:20px'><INPUT TYPE=checkbox NAME=current VALUE=1 onclick='useCurrentAvatar();'>Use my current avatar.</div><br><br><font color=#444444 face=arial><b>Option Three:"
	'End If
       ' OutputForm()
	'response.write "<br>" & optionsconfig & "</b></font><font face=arial> Select an avatar from the gallery below.</font>"
	'If listTheFiles(AVATAR_DIRECTORY)<>0 Then
	'	response.write "<br>" & filetable
	'End If
    end if
else
    response.write SaveFiles()
    if errorstring<>"" then
	if (ALLOW_UPLOADS=1) Then
		Write_upload_option()
		i = i + 1
	End If
	if (USE_GRAVATAR=1) Then
		option2="<br><br><div style='background-color:#eeeeee;border:2px solid gray;-moz-border-radius: 4px;-webkit-border-radius: 4px;border-radius:4px;padding:6px'><font color=#444444 face=arial><b><script>document.write(" & ref & ".fc_chat.textSetter(" & arr(i) & "))</script></b></font>&nbsp;<font face=arial> <script>document.write(" & ref & ".fc_chat.textSetter(196))</script>.</font><br><br><div style='margin-left:20px'><INPUT id='fc_imagelink' TYPE=text NAME='imagelink' VALUE='' style='width:200px'> <input type='button' name='Submit' value='' id='submitbutton2' onclick='useimagelink();'><script>document.getElementById('submitbutton2').value=" & ref & ".fc_chat.textSetter(198)</script><br><script>document.write(" & ref & ".fc_chat.textSetter(199))</script><br><br></div></div><br>"
		i = i + 1
	End If	
	if (USE_BOARD_AVATARS=1) Then
		option3="<br><div style='background-color:#eeeeee;border:2px solid gray;-moz-border-radius: 4px;-webkit-border-radius: 4px;border-radius:4px;padding:6px'>&nbsp;<font color=#444444 face=arial><b><script>document.write(" & ref & ".fc_chat.textSetter(" & arr(i) & "))</script></b></font><font face=arial> <script>document.write(" & ref & ".fc_chat.textSetter(200))</script>.</font><br><br><div style='margin-left:20px'><INPUT TYPE=checkbox NAME='current' VALUE='1' onclick='useCurrentAvatar();'><script>document.write(" & ref & ".fc_chat.textSetter(201))</script>.<br><br></div></div><br>"
		i = i + 1
	End If
	if (USE_GALLERY=1) Then
		option4="<br><div style='background-color:#eeeeee;border:2px solid gray;-moz-border-radius: 4px;-webkit-border-radius: 4px;border-radius:4px;padding:6px'>&nbsp;<font color=#444444 face=arial><b><script>document.write(" & ref & ".fc_chat.textSetter(" & arr(i) & "))</script></b></font><font face=arial> &nbsp;<script>document.write(" & ref & ".fc_chat.textSetter(202))</script>.</font><br></div>"
		i = i + 1
		If listTheFiles(AVATAR_DIRECTORY)<>0 Then
			option4 = option4 & "<br>" & filetable
		End If
	End If
	response.write option2 & option3 & option4
    end if
    response.write "<br><br>"
end if

%>
<br>
<!-- Please support this free script by having a link to freeaspupload.net either in this page or somewhere else in your site. -->
<div style="border-bottom: #A91905 2px solid;font-size:10">Powered by <A HREF="http://www.freeaspupload.net/" style="color:black">Free ASP Upload</A></div></div>

<br><br>


</BODY>
</HTML>
