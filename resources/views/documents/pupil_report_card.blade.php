<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>
            Pupil Report Card
        </title>
		<style>
			table{
				border-collapse: collapse;
				margin:auto ;
				padding: auto;
				height: 500px;
				width: 50%;
			}

			.container p{
				text-align: center;
			}

			.container h1{
				font-size: 20px;
				text-align: center;
			}

			th{
				padding: 2px 83px;
				font-family: system-ui,-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif
			}

			td{
				padding: 2px 83px;
				font-family: system-ui,-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif
			}

			span{
				font-weight: bold;
				margin: 2px;
			}
		</style>
		</head>
		<body>
		  <div class="container">
			<div class="school_details" style="text-align: center; margin-bottom:50px;">
				<h1>SKaranja Junior/Senior School</h1>
				<h4>Phone:0702521351 <span> Email:stephewaweru@gmail.com</span></h4>
			</div>
			  <h1>{{ $pupilresults->pupilname->pupil_name }} Report Card</h1>
			  <p>Results</p>
			  <table border="1px">
				  <tr>
					  <td colspan="3"><span>Reg No:</span>{{ $pupilresults->pupilname->pupil_reg_number }}</td>
				  </tr>
				  <tr>
					  <td colspan="3"><span>Exam Name:</span>{{ $pupilresults->pupilexam->exam_name }}</td>
					  <td colspan="6"><span>Class:</span>{{ $pupilresults->studentgrade->grade_name }}</td>
				  </tr>
				  <tr>
					  <td colspan="6"><span>Name:</span>{{ $pupilresults->pupilname->pupil_name }}</td>
					  <td colspan="6"><span>Parent/Guardian Name:</span>{{ $pupilresults->pupilname->pupil_guardian_name }}</td>
				  </tr>
				  <tr style="background-color:rgb(152, 111, 172)">
					  <th>Id</th>
					  <th>Subects</th>
					  <th>Marks</th>
				  </tr>
				  <tr>
					  <td>1</td>
					  <td>Mathematics</td>
					  <td>{{ $pupilresults->maths }}</td>
				  </tr>
					<tr>
						<td>2</td>
						<td>English</td>
						<td>{{ $pupilresults->eng }}</td>
					</tr>
					<tr>
						<td>3</td>
						<td>Kiswahili</td>
						<td>{{ $pupilresults->kiswa }}</td>
					</tr>
					<tr>
						<td>4</td>
						<td>Science</td>
						<td>{{ $pupilresults->sci }}</td>
					</tr>
					<tr>
						<td>5</td>
						<td>Home Science</td>
						<td>{{ $pupilresults->home_sci }}</td>
					</tr>
					<tr>
						<td>6</td>
						<td>CRE</td>
						<td>{{ $pupilresults->cre }}</td>
					</tr>
					<tr>
						<td>7</td>
						<td>Social Studies</td>
						<td>{{ $pupilresults->social_stud }}</td>
					</tr>
				  <tr style="background-color:rgb(207, 135, 240)">
					  	<th colspan="6">Total Marks {{ $pupilresults->total_marks }}/500<br> mean Grade {{ $pupilresults->mean }}
						</th>
					  {{-- <th colspan="6">ReMarks:Pass</th> --}}
				  </tr>
			  </table>
		  </div>
		</body>
</html>