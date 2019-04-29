<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefaultinformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            //Add superadmin account
            DB::table('users_admin')->insert(array(
                'id_num' => 'superadmin01',
                'email' => 'itstaff.ptc@gmail.com',
                'firstname' => 'super',
                'lastname' => 'admin',
                'password' => Hash::make('admin'),
                'usertype' => 'superadmin',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
                
            ));

            //Add superadmin profile
            DB::table('admin_information')->insert(array(
                'user_id' => '1',
                'firstname' => 'super',
                'lastname' => 'admin',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')

            ));

            //Add instructor account
            DB::table('users_instructor')->insert(array(
                'id_num' => 'gloriagarcia',
                'email' => 'gloriagarcia@ptc-edu.ph',
                'firstname' => 'Gloria',
                'lastname' => 'Garcia',
                'password' => Hash::make('garcia'),
                'usertype' => 'instructor',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
                
            ));

            DB::table('users_instructor')->insert(array(
                'id_num' => 'corneliolamera',
                'email' => 'corneliolamera@ptc-edu.ph',
                'firstname' => 'Cornelio',
                'lastname' => 'Lamera',
                'password' => Hash::make('lamera'),
                'usertype' => 'instructor',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
                
            ));

            //Add instructor profile
            DB::table('instructor_information')->insert(array(
                'user_id' => '1',
                'firstname' => 'Gloria',
                'lastname' => 'Garcia',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')

            ));

            DB::table('instructor_information')->insert(array(
                'user_id' => '2',
                'firstname' => 'Cornelio',
                'lastname' => 'Lamera',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')

            ));

            //Add student account
            DB::table('users_student')->insert(array(
                'id_num' => 'EC2017-0357',
                'email' => 'bsit.kristian@gmail.com',
                'firstname' => 'Kristian',
                'lastname' => 'See Te',
                'password' => Hash::make('kristian'),
                'usertype' => 'student',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
                
            ));

            //Add student profile
            DB::table('student_information')->insert(array(
                'user_id' => '1',
                'id_num' => 'EC2017-0357',
                'firstname' => 'Kristian',
                'lastname' => 'See Te',
                'student_type' => 'old student',
                'cd_email' => 'bsit.kristian@gmail.com',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')

            ));


            //Add Semester
            DB::table('semester_info')->insert(array(
                'title' => '1st Sem',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')

            ));
            DB::table('semester_info')->insert(array(
                'title' => '2nd Sem',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')

            ));

            DB::table('semester_info')->insert(array(
                'title' => '3rd Sem',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')

            ));

            //Add Year Level
            DB::table('yearlevel_info')->insert(array(
                'title' => 'First Year',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')

            ));

            DB::table('yearlevel_info')->insert(array(
                'title' => 'Second Year',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')

            ));

            DB::table('yearlevel_info')->insert(array(
                'title' => 'Third Year',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')

            ));

            DB::table('yearlevel_info')->insert(array(
                'title' => 'Fourth Year',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')

            ));

            DB::table('yearlevel_info')->insert(array(
                'title' => 'Grade 11',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')

            ));

            DB::table('yearlevel_info')->insert(array(
                'title' => 'Grade 12',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')

            ));

            //Add Section
            DB::table('section_info')->insert(array(
                'title' => 'A',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')

            ));

            DB::table('section_info')->insert(array(
                'title' => 'B',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')

            ));

            DB::table('section_info')->insert(array(
                'title' => 'C',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')

            ));

            DB::table('section_info')->insert(array(
                'title' => 'D',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')

            ));

            DB::table('section_info')->insert(array(
                'title' => 'Executive',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')

            ));

            DB::table('section_info')->insert(array(
                'title' => 'Senior High School',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')

            ));

            //Add program information
            DB::table('program_information')->insert(array(
                'program_code' => 'ABA',
                'descriptive_title' => 'Associate in Business Administration',
                'advising_id' => '1',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')

            ));
            DB::table('program_information')->insert(array(
                'program_code' => 'COA',
                'descriptive_title' => 'Certificate in Office Administration',
                'advising_id' => '1',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')

            ));
            DB::table('program_information')->insert(array(
                'program_code' => 'CCS',
                'descriptive_title' => 'Certificate in Computer Science',
                'advising_id' => '2',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')

            ));
            DB::table('program_information')->insert(array(
                'program_code' => 'CHRM',
                'descriptive_title' => 'Certificate in Hotel and Restaurant Management',
                'advising_id' => '1',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')

            ));
            DB::table('program_information')->insert(array(
                'program_code' => 'BSIT',
                'descriptive_title' => 'Bachelor of Science in Information Technology',
                'advising_id' => '2',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')

            ));
            DB::table('program_information')->insert(array(
                'program_code' => 'BSOA',
                'descriptive_title' => 'Bachelor of Science in Office Administration',
                'advising_id' => '1',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')

            ));
            DB::table('program_information')->insert(array(
                'program_code' => 'BSIT-EXEC',
                'descriptive_title' => 'Executive - Bachelor of Science in Information Technology',   
                'advising_id' => '2',     
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')

            ));
            DB::table('program_information')->insert(array(
                'program_code' => 'BSOA-EXEC',
                'descriptive_title' => 'Executive - Bachelor of Science in Office Administration',
                'advising_id' => '1',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')

            ));
            DB::table('program_information')->insert(array(
                'program_code' => 'ABM',
                'descriptive_title' => 'Accountancy, Business and Management',
                'advising_id' => '1',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')

            ));
            DB::table('program_information')->insert(array(
                'program_code' => 'HUMSS',
                'descriptive_title' => 'Humanities and Social Science',        
                'advising_id' => '1',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')

            ));
            DB::table('program_information')->insert(array(
                'program_code' => 'TECH-VOC ICT',
                'descriptive_title' => 'Tech-Voc Information and Communications Technology',
                'advising_id' => '1',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')

            ));

            //Add School Year
            DB::table('school_year')->insert(array(
                'title' => '2018-2019',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            ));

            DB::table('school_year')->insert(array(
                'title' => '2019-2020',
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            ));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('defaultinformation');
    }
}
