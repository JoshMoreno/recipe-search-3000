import {decimal} from "vscode-languageserver-types";

export interface FetchRecipesResponse extends PaginatedResponse {
    data: Recipe[]
}

export interface PaginatedResponse {
    current_page: number
    first_page_url: string
    from: number
    last_page: number
    last_page_url: string
    links: PaginationLink[]
    next_page_url: string|null
    path: string
    per_page: number
    prev_page_url: string|null
    to: number
    total: number
}

export interface PaginationLink {
    url: string|null
    label: string
    active: boolean
}

export interface Recipe {
    id: number
    name: string
    description: string
    author_email: string
    slug: string
    created_at: string
    updated_at: string
}

export interface RecipeDetail extends Recipe {
    ingredients: Ingredient[]
    steps: Step[]
}

export interface Ingredient {
    id: number
    recipe_id: number
    quantity: decimal
    unit: string
    name: string
}

export interface Step {
    id: number
    recipe_id: number
    description: string
    order: number
}
