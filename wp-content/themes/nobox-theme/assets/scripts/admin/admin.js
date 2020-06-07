// Avaktivera "svagt lösenord" på profilen
jQuery('.pw-checkbox').prop('disabled', true);
jQuery('.pw-weak label').append('<p style="margin:10px 0 0 0;">Du måste ange ett <strong>starkt</strong> lösenord för att skapa en användare. <br> <em>Tips: Använd <u>stora</u> och <u>små bokstäver</u>, <u>siffror</u> och <u>symboler</u> samt minst 14 tecken långt.</em></p>');
