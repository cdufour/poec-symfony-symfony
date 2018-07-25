import { Component, OnInit } from '@angular/core';
import { DataService } from '../data.service';

interface Category {
  id: number;
  label: string
}

interface Difficulty {
  id: number;
  label: string;
}

interface Answer {
  id: number;
  label: string;
}

interface Question {
  id: number;
  label: string;
  choices: Answer[];
}

@Component({
  selector: 'app-quizz',
  templateUrl: './quizz.component.html',
  styleUrls: ['./quizz.component.css']
})
export class QuizzComponent implements OnInit {
  categories: Category[] = [];
  difficulties: Difficulty[] = [];
  questions: Question[] = [];

  selectCategory: number = 0;
  selectDifficulty: number = 0;
  nbQuestions: number = 10;

  isQcmReceived: boolean = false; // qcm reçu ou pas
  indexQuestion: number = 0;

  constructor(private dataService: DataService) { }

  ngOnInit() {

    this.dataService.getCategories()
      .subscribe((res: Category[]) => {
        this.categories = res;
      });

    this.dataService.getDifficulties()
      .subscribe((res: Difficulty[]) => {
        this.difficulties = res;
      });
  }

  submit() {
    let params: string =
      `?cat=${this.selectCategory}&dif=${this.selectDifficulty}&nbq=${this.nbQuestions}`;

    this.dataService.getQuizz(params)
      .subscribe((res: Question[]) => {
        this.isQcmReceived = true;
        this.questions = res;
      })
  }

  validQuestion() {
    // envoi au serveur pour validation

    // passage à la question suivante
    if (this.indexQuestion < this.questions.length - 1) {
      this.indexQuestion++;
    }
  }

}


//
