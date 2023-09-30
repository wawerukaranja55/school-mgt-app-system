<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>
            Pupil Termly Report Card
        </title>
		<style>
			table{
				border-collapse: collapse;
				margin:auto ;
				padding: auto;
				height: 500px;
				width: 70%;
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
			<div class="school_details" style="text-align: center; margin-bottom:50px;">
				<h1>Pupil Details</h1>
				<h4>Reg No:<span>{{ $pupildetails->pupil_reg_number }}</span></h4>
				<h4>Name:<span>{{ $pupildetails->pupil_name }}</span></h4>
				<h4>Parent/Guardian Name:<span>{{ $pupildetails->pupil_guardian_name }}</span></h4>
				<h4>Class:<span>{{ $pupildetails->grade_id }}</span></h4>
				<h4>Mean Grade For the Term:<span>{{ $pupilmean->mean }}</span></h4>
			</div>
			  <p>Results</p> 	

				  @foreach ( $pupilresults as $result)
				  <table>
				  		<h3 style="text-align: center;">Exam Results For {{ $result->pupilexam->exam_name }}</h3>
						<tr style="background-color:rgb(152, 111, 172)">
							<th>Id</th>
							<th>Subects</th>
							<th>Marks</th>
						</tr>
						<tr>
							<td>1</td>
							<td>Mathematics</td>
							<td>{{ $result->maths }}</td>
						</tr>
						<tr>
							<td>2</td>
							<td>English</td>
							<td>{{ $result->eng }}</td>
						</tr>
						<tr>
							<td>3</td>
							<td>Kiswahili</td>
							<td>{{ $result->kiswa }}</td>
						</tr>
						<tr>
							<td>4</td>
							<td>Science</td>
							<td>{{ $result->sci }}</td>
						</tr>
						<tr>
							<td>5</td>
							<td>Home Science</td>
							<td>{{ $result->home_sci }}</td>
						</tr>
						<tr>
							<td>6</td>
							<td>CRE</td>
							<td>{{ $result->cre }}</td>
						</tr>
						<tr>
							<td>7</td>
							<td>Social Studies</td>
							<td>{{ $result->social_stud }}</td>
						</tr>
						<tr style="background-color:rgb(207, 135, 240)">
								<th colspan="6">Total Marks {{ $result->total_marks }}/500<br> mean Grade {{ $result->mean }}
								</th>
							{{-- <th colspan="6">ReMarks:Pass</th> --}}
						</tr>
					</table>
				  @endforeach


			  
		  </div>
		</body>
</html>