<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignCategoryPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //aggiungo colonna
            $table->unsignedBigInteger('category_id')->nullable()->after('slug');//creo chiave secondaria in posts, può essere nullo e verra posizionato dopo "slug" nella tabella
            
            //collego la chiave secondaria di post a quella primaria di category
            $table->foreign('category_id') //chiave secondaria di Post
                ->references('id') //collego ad id
                ->on('categories') //di category
                ->onDelete('set null'); //alla cancellazione di category setta null nella colonna di post
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            
            //tolgo chiava esterna
            $table->dropForeign(['category_id']); //oppure nomeTabella_chiaveEsterna_foreign
            //tolgo colonna
            $table->dropColumn('category_id');


        });
    }
}
