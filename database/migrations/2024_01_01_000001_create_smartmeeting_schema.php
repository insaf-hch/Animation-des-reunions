<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
  public function up(): void {
    Schema::table('users', function (Blueprint $table) {
      $table->string('role')->default('Membre')->after('email');
    });
    Schema::create('meetings', function (Blueprint $table) {
      $table->id();
      $table->string('titre');
      $table->string('type')->default('Autre');
      $table->string('lieu')->nullable();
      $table->date('date_reunion');
      $table->time('heure_debut');
      $table->integer('duree')->default(60);
      $table->enum('statut',['A venir','En cours','Terminee'])->default('A venir');
      $table->enum('priorite',['Normal','Important','Urgent'])->default('Normal');
      $table->string('lien_reunion')->nullable();
      $table->foreignId('createur_id')->constrained('users')->cascadeOnDelete();
      $table->timestamps();
    });
    Schema::create('participants', function (Blueprint $table) {
      $table->id();
      $table->foreignId('meeting_id')->constrained()->cascadeOnDelete();
      $table->foreignId('user_id')->constrained()->cascadeOnDelete();
      $table->enum('role_reunion',['Animateur','Rapporteur','Participant'])->default('Participant');
      $table->boolean('presence')->default(false);
      $table->timestamps();
    });
    Schema::create('agendas', function (Blueprint $table) {
      $table->id();
      $table->foreignId('meeting_id')->constrained()->cascadeOnDelete();
      $table->string('titre');
      $table->integer('duree')->default(15);
      $table->integer('ordre')->default(1);
      $table->enum('statut',['En attente','En cours','Termine'])->default('En attente');
      $table->timestamps();
    });
    Schema::create('decisions', function (Blueprint $table) {
      $table->id();
      $table->foreignId('meeting_id')->constrained()->cascadeOnDelete();
      $table->text('texte');
      $table->timestamps();
    });
    Schema::create('tasks', function (Blueprint $table) {
      $table->id();
      $table->foreignId('meeting_id')->nullable()->constrained()->nullOnDelete();
      $table->string('responsable')->nullable();
      $table->string('titre');
      $table->enum('priorite',['Normal','Important','Urgent'])->default('Normal');
      $table->date('deadline')->nullable();
      $table->enum('statut',['En cours','En retard','Terminee'])->default('En cours');
      $table->timestamps();
    });
    Schema::create('notes', function (Blueprint $table) {
      $table->id();
      $table->foreignId('meeting_id')->constrained()->cascadeOnDelete();
      $table->text('contenu');
      $table->timestamps();
    });
  }
  public function down(): void {
    Schema::dropIfExists('notes');
    Schema::dropIfExists('tasks');
    Schema::dropIfExists('decisions');
    Schema::dropIfExists('agendas');
    Schema::dropIfExists('participants');
    Schema::dropIfExists('meetings');
    Schema::table('users', function (Blueprint $table) {
      $table->dropColumn('role');
    });
  }
};
